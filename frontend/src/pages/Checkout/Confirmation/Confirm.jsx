import { useEffect, useState } from 'react';
import CartBreadcrumb from '../../../components/CartBreadcrumb/CartBreadcrumb';
import './Confirm.scss';
import { useOutletContext } from 'react-router-dom';

function Confirm() {
    const [result, setResult] = useState([]);
    const { setNotification } = useOutletContext();

    useEffect(() => {
        // numéro de commande et mail
        const commandIdAndMail = async () => {
            try {
                const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/getIdAndMail.php`, {
                    credentials: 'include'
                });
                const idAndMail = await response.json();
                setResult(idAndMail);
            } catch (error) {
                console.error("Error in fetching payment informations: ", error);
            }
        }
        const emptyCart = async () => {
            try {
                await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/emptyCart.php`, {
                    credentials: 'include'
                });
            } catch (error) {
                console.error("Error during payment.")
            }
        }
        commandIdAndMail();
        emptyCart();
        setNotification(0);
    }, []);

    return (
        <>
            <CartBreadcrumb
                classname={"confirmation"} />
            <main className='confirm'>
                <h2 className='confirm__title'>Votre commande n°{result.command_id} a bien été prise en compte.</h2>
                <p className='confirm__p'>Un e-mail récapitulatif ne vient pas de vous être envoyé à l&apos;adresse suivante : {result.email}. </p>
                <h2>Donnez-nous votre avis !</h2>
                <p className='confirm__p'>Etes-vous globalement satisfait de votre expérience d&apos;achat sur Furet.com ?</p>
                <p className='confirm__p'>Cliquez pour donner votre note sur 5 ↴</p>
                <span className='confirm__stars'>
                    <img src={`${import.meta.env.VITE_BACKEND_URL}Public/images/filledstar.png`} />
                    <img src={`${import.meta.env.VITE_BACKEND_URL}Public/images/filledstar.png`} />
                    <img src={`${import.meta.env.VITE_BACKEND_URL}Public/images/filledstar.png`} />
                    <img src={`${import.meta.env.VITE_BACKEND_URL}Public/images/filledstar.png`} />
                    <img src={`${import.meta.env.VITE_BACKEND_URL}Public/images/emptystar.png`} />
                </span>
                <p className='confirm__p'>Merci de votre confiance.</p>
                <p className='confirm__p'>L&apos;équipe Furet.com</p>
            </main>
        </>
    );
}

export default Confirm;