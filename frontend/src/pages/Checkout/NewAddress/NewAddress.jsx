import { useRef, useState } from "react";
import CartBreadcrumb from "../../../components/CartBreadcrumb/CartBreadcrumb";
import "./NewAddress.scss";
import "../../CreateAccount/CreateAccount.scss";
import { useNavigate } from "react-router-dom";

function NewAddress() {
    const labelRef = useRef();
    // const gender = ;
    const firstnameRef = useRef();
    const lastnameRef = useRef();
    const addressRef = useRef();
    const addressDetailsRef = useRef();
    const cityRef = useRef();
    const regionRef = useRef();
    const countryRef = useRef();
    const phoneRef = useRef();

    const [message, setMessage] = useState();
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('label', labelRef.current.value);
        formData.append('firstname', firstnameRef.current.value);
        formData.append('lastname', lastnameRef.current.value);
        formData.append('address', addressRef.current.value);
        formData.append('addressDetails', addressDetailsRef.current.value);
        formData.append('city', cityRef.current.value);
        formData.append('region', regionRef.current.value);
        formData.append('country', countryRef.current.value);
        formData.append('phone', phoneRef.current.value);

        try {
            const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/createNewAddress.php`, {
                method: "POST",
                body: formData,
                credentials: 'include',
            });
            const message = await response.text();
            if (message === "Nouvelle adresse créée.") {
                navigate('/checkout/delivery');
            } else {
                setMessage("Une erreur s'est produite.");
            }
        } catch (error) {
            console.error("Error while submitting new adress: ", error);
        }
    }

    return (
        <>
            <CartBreadcrumb
                classname={"delivery"} />
            <span className="identification__redirect">
                <h3 className="cart__redirect--title">Nouvelle adresse</h3>
            </span>
            <form onSubmit={handleSubmit} className="newAddress">

                <span className="newAddress__spans">
                    <label htmlFor="label">Nom&nbsp;de&nbsp;l&apos;adresse*&nbsp;:</label>
                    <input className="delivery__input--text" id="label" ref={labelRef} required />
                </span>

                <span>
                    <label htmlFor="gender">Civilité*&nbsp;:</label>
                    <span className="createAccount__genders">
                        <input type="radio" id="mme" name="gender" value="mme" />
                        <label htmlFor="mme">Mme</label>
                        <input type="radio" id="m" name="gender" value="m" />
                        <label htmlFor="m">M.</label>
                        {/* gérer l'input radio en ref ou avec un state ? */}
                    </span>
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="firstname">Prénom*&nbsp;:</label>
                    <input className="delivery__input--text" id="firstname" ref={firstnameRef} required />
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="lastname">Nom*&nbsp;:</label>
                    <input className="delivery__input--text" id="lastname" ref={lastnameRef} required />
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="address">Adresse*&nbsp;:</label>
                    <input className="delivery__input--text" id="address" ref={addressRef} required />
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="addressDetails">Détails&nbsp;de&nbsp;l&apos;adresse&nbsp;:</label>
                    <input className="delivery__input--text" id="addressDetails" ref={addressDetailsRef} />
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="city">Ville*&nbsp;:</label>
                    <input className="delivery__input--text" id="city" ref={cityRef} required />
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="region">Région*&nbsp;:</label>
                    <input className="delivery__input--text" id="region" ref={regionRef} required />
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="country">Pays*&nbsp;:</label>
                    <input className="delivery__input--text" id="country" ref={countryRef} required />
                </span>

                <span className="newAddress__spans">
                    <label htmlFor="phone">Numéro&nbsp;de&nbsp;téléphone&nbsp;:</label>
                    <input className="delivery__input--text" id="phone" ref={phoneRef} />
                </span>

                <p>{message}</p>
                <button className="newAddress__button" type="submit">Valider&nbsp;mon&nbsp;adresse</button>
            </form>
        </>
    );
}

export default NewAddress;