import { useEffect, useState } from 'react';
import CartBreadcrumb from '../../../components/CartBreadcrumb/CartBreadcrumb';
import './Delivery.scss';
import { useNavigate } from 'react-router-dom';

function Delivery() {
    const [addressesArray, setAddressesArray] = useState([]);

    const navigate = useNavigate();

    useEffect(() => {
        const addressFetch = async () => {
            try {
                const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/getUserAddresses.php`, {
                    credentials: 'include'
                });
                const addresses = await response.json();
                setAddressesArray(addresses);
            } catch (error) {
                console.error("Error while fetching addresses: ", error);
            }
        }
        addressFetch();
    }, [])

    const handleClick = async (id, label) => {
        try {
            const formData = new FormData();
            formData.append('user_id', id);
            formData.append('address_label', label);

            const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/createCommand.php`, {
                method: "POST",
                body: formData,
                credentials: 'include'
            });

            const message = await response.text();

            if (message === "Nouvelle commande créée.") {
                navigate("/checkout/payment");
            }
        } catch (error) {
            console.error("Error in command creation: ", error);
        }
    }

    return (
        <>
            <CartBreadcrumb
                classname={"delivery"} />
            <span className="identification__redirect">
                <h3 className="cart__redirect--title">Choisir une adresse de livraison</h3>
            </span>
            <main className='delivery__main'>
                {addressesArray.map((address) => (

                    <article
                        key={`${address.user_id}${address.address_label}`}
                        onClick={() => handleClick(address.user_id, address.address_label)}
                        className='delivery__addressCard'>
                        <h2>{address.address_label.charAt(0).toUpperCase() + address.address_label.slice(1).toLowerCase()}</h2>
                        <p>{address.address}</p>
                        <p>{address.address_details}</p>
                        <p>{address.city}</p>
                        <p>{address.region}</p>
                        <p>{address.country}</p>
                        <p>{address.phone}</p>
                    </article>
                ))}
                <article onClick={() =>
                    navigate('/checkout/newaddress')}
                    className='delivery__addressCard delivery__addressCard--new'>
                    <span>+</span>
                    <p>Ajouter une nouvelle adresse.</p>
                </article>
            </main>
        </>
    );
}

export default Delivery;