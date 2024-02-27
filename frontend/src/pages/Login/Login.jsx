import { useRef, useState } from 'react';
import './Login.scss';
import { Link, useNavigate } from 'react-router-dom';

function Login() {
    const [authError, setAuthError] = useState("");
    const emailRef = useRef();
    const passwordRef = useRef();
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const formData = new FormData();
            formData.append('email', emailRef.current.value);
            formData.append('password', passwordRef.current.value);
            console.log(formData);

            const response = await fetch('http://decitrephpbackend/src/userRoutes/authentication.php', {
                method: "POST",
                body: formData,
            });

            console.log('response', response);
            if (response.ok) {
                console.log("response is ok");
                const errorMessage = await response.text();
                if (errorMessage === 'No matching account') {
                    // proposer la création de compte
                    setAuthError("Votre email et/ou votre mot de passe ne correspondent pas.")
                } else if (errorMessage) {
                    // gérer les erreurs de frappe
                    console.log("Error: ", errorMessage);
                } else {
                    // fetch les informations du user connecté et vérifie que sa session est toujours en cours
                    console.log("There's a matching acc");
                    /* try {
                        const response = await fetch('http://decitrephpbackend/src/userRoutes/getOneUser.php', {
                            credentials: 'include'
                        });       
                        console.log("second fetch response", response);             
                        const user = await response.json();
                        console.log("user", user);
                    } catch (error) {
                        console.error("Error while fetching user's data ", error);
                    } */
                    navigate("/checkout/cart"); 
                }

            }
        } catch (error) {
            console.error('Error during authentication: ', error);
        }
    }


    return (
        <main className='login'>
            <p className='login__welcome breadcrumb'>Connexion</p>
            <section className='login__connection'>
                <aside className='login__asides'>
                    <h3 className='login__titles'>Vous avez déjà un compte ?</h3>
                    <form className='login__form' onSubmit={handleSubmit} >
                        <span>
                            <label htmlFor='email'>Adresse mail</label>
                            <input id='email' type='email' ref={emailRef} />
                            <label htmlFor='password'>Mot de passe</label>
                            <input id='password' type='password' ref={passwordRef} />
                        </span>
                        <p className='login__error'>{authError}</p>
                        <button className='login__submit' type='submit'>Connexion</button>
                    </form>
                </aside>
                <aside className='login__asides login__asides--right'>
                    <h3 className='login__titles'>Vous êtes un nouveau client ?</h3>
                    <p>En créant un compte, commandez rapidement, consultez vos achats et bien plus encore !</p>
                    <Link to="/customer/account/create" >
                        <button className='login__submit'>Créer un compte</button>
                    </Link>
                </aside>
            </section>
        </main>
    );
}

export default Login;