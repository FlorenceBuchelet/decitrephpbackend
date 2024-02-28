import { useEffect, useRef, useState } from "react";
import "./Profile.scss";

function Profile() {
    const [user, setUser] = useState([{}]);
    const emailRef = useRef();
    // gender
    const firstnameRef = useRef("");
    const lastnameRef = useRef("");
    const phoneRef = useRef("");
    const addressRef = useRef("");

    // préremplissage du form
    useEffect(() => {

        const currentUser = async () => {
            try {
                const response = await fetch('http://decitrephpbackend/src/userRoutes/getOneUser.php', {
                    credentials: 'include'
                });
                const fetchedUser = await response.json();
                setUser(fetchedUser);

                emailRef.current.value = fetchedUser[0].email;
                firstnameRef.current.value = fetchedUser[0].firstname;
                lastnameRef.current.value = fetchedUser[0].lastname;
                phoneRef.current.value = fetchedUser[0].phone;
                addressRef.current.value = fetchedUser[0].address;
            } catch (error) {
                console.error("Error in fetching user data: ", error)
            }
        }
        currentUser();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('userId', user[0].user_id);
        formData.append('email', emailRef.current.value);
        // formData.append('gender', ??);
        formData.append('firstname', firstnameRef.current.value);
        formData.append('lastname', lastnameRef.current.value);
        formData.append('phone', phoneRef.current.value);
        formData.append('address', addressRef.current.value);

        try {
            const response = await fetch(`http://decitrephpbackend/src/userRoutes/updateUser.php`,
                {
                    method: "POST",
                    body: formData
                });
            if (response.ok) {
                console.log("user updated.");
            }
        } catch (error) {
            console.error("Error in updating user data: ", error);
        }
    };

    return (
        <>
            <p><span className="breadcrumb profile__breadcrumb">Mon compte &gt; </span><span className="breadcrumb">Informations du compte</span></p>
            <h2 className="profile__title">Mes informations personnelles</h2>
            <form onSubmit={handleSubmit} className="profile__form">
                <label htmlFor="email">Adresse mail* :</label>
                <input className="profile__input--text" id="email" type="email" ref={emailRef} required />
                <label htmlFor="gender">Civilité* :</label>
                <span className="profile__genders">
                    <input type="radio" id="mme" name="gender" value="mme" />
                    <label htmlFor="mme">Mme</label>
                    <input type="radio" id="m" name="gender" value="m" />
                    <label htmlFor="m">M.</label>
                    {/* gérer l'input radio en ref ou avec un state ? */}
                </span>
                <label htmlFor="firstname">Prénom* :</label>
                <input className="profile__input--text" id="firstname" ref={firstnameRef} required />
                <label htmlFor="lastname">Nom* :</label>
                <input className="profile__input--text" id="lastname" ref={lastnameRef} required />
                <label htmlFor="phone">Numéro de téléphone :</label>
                <input className="profile__input--text" type="tel" id="phone" ref={phoneRef} required />
                <label htmlFor="address">Adresse de livraison :</label>
                <input className="profile__input--text" id="address" ref={addressRef} required />
                <button className="profile__form--button" type="submit">Sauvegarder</button>
            </form>
        </>
    );
}

export default Profile;