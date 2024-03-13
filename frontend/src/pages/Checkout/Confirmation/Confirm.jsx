import { useEffect } from 'react';
import CartBreadcrumb from '../../../components/CartBreadcrumb/CartBreadcrumb';
import './Confirm.scss';

function Confirm() {
    useEffect(() => {

    }, []);

    return (
        <>
            <CartBreadcrumb
                classname={"confirmation"} />
            <main className='confirm'>
                <h2 className='confirm__title'>Votre commande n°{ } a bien été prise en compte.</h2>
                <p className='confirm__p'>Un e-mail récapitulatif ne vient pas de vous être envoyé à l&apos;adresse suivante : { }. </p>
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