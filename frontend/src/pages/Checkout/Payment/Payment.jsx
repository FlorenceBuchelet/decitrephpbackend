import { useNavigate } from 'react-router-dom';
import CartBreadcrumb from '../../../components/CartBreadcrumb/CartBreadcrumb';
import './Payment.scss';

function Payment() {
    const navigate = useNavigate();

    const handleClick = async () => {
        navigate('/checkout/confirmation');
    }

    return (
        <>
            <CartBreadcrumb
                classname={"payment"} />
            <span className="identification__redirect">
                <h3 className="cart__redirect--title">Choisissez votre mode de paiement</h3>
            </span>
            <span className='payment__payzen'>
                <p>Vous avez choisi le paiement en ligne par carte bancaire. Vous n&apos;allez pas être redirigé sur le site sécurisé de Payzen, prestataire de paiement de Furet.com.</p>
                <img src={`${import.meta.env.VITE_BACKEND_URL}public/images/payzen.png`} />
            </span>
            <main className='payment__main'>
                <button
                    onClick={handleClick}
                    className='payment__button'>
                    <img src={`${import.meta.env.VITE_BACKEND_URL}Public/images/secure.png`} />
                    Valider votre commande
                </button>
            </main>
        </>
    );
}

export default Payment;