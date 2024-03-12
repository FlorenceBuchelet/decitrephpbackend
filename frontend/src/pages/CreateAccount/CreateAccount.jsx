import { useRef, useState } from "react";
import "./CreateAccount.scss";
import { useNavigate } from "react-router-dom";

function CreateAccount() {
    const [errorMessage, setErrorMessage] = useState('');
    const emailRef = useRef();
    // gender
    const firstnameRef = useRef();
    const lastnameRef = useRef();
    const passwordRef = useRef();

    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const formData = new FormData();
            formData.append('email', emailRef.current.value);
            // formData.append('gender', ??);
            formData.append('firstname', firstnameRef.current.value);
            formData.append('lastname', lastnameRef.current.value);
            formData.append('password', passwordRef.current.value);

            const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/createUser.php`, {
                method: "POST",
                body: formData,
                credentials: 'include',
            });
            const message = await response.text();

            if (message === "Email already in use") {
                setErrorMessage("Cet email est déjà associé à un compte, vous allez être redirigé.")
                setTimeout(() => navigate('/customer/account/login'), 3000);
            } else {
                setErrorMessage("Vous pouvez maintenant vous connecter, vous allez être redirigé.");
                setTimeout(() => navigate('/customer/account/login'), 3000);
            }

        } catch (error) {
            console.error("Error in creating user: ", error);
        }
    }

    return (
        <main>
            <p className="breadcrumb">Créer un compte</p>
            <h2 className="createAccount__title">Créer un compte</h2>
            <form onSubmit={handleSubmit} className="createAccount__form">
                <label htmlFor="email">Adresse mail* :</label>
                <input className="createAccount__input--text" id="email" type="email" ref={emailRef} required />
                <label htmlFor="gender">Civilité* :</label>
                <span className="createAccount__genders">
                    <input type="radio" id="mme" name="gender" value="mme" />
                    <label htmlFor="mme">Mme</label>
                    <input type="radio" id="m" name="gender" value="m" />
                    <label htmlFor="m">M.</label>
                    {/* gérer l'input radio en ref ou avec un state ? */}
                </span>
                <label htmlFor="firstname">Prénom* :</label>
                <input className="createAccount__input--text" id="firstname" ref={firstnameRef} required />
                <label htmlFor="lastname">Nom* :</label>
                <input className="createAccount__input--text" id="lastname" ref={lastnameRef} required />
                <label htmlFor="password">Mot de passe* :</label>
                <input className="createAccount__input--text" id="password" type="password" ref={passwordRef} required />
                <p className="createAccount__password--specs">Il doit contenir 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial. </p>
                <p className="createAccount__mandatory">* Champs obligatoires</p>
                <p>{errorMessage}</p>
                <button className="createAccount__form--button" type="submit">Valider</button>
            </form>
        </main>
    );
}

export default CreateAccount;