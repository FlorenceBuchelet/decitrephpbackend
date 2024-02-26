import { useRef } from 'react';
import './Login.scss';
import { Link, useNavigate } from 'react-router-dom';

function Login() {
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

            // ok je n'ai pas besoin de lire le cookie
            // Je dois faire une seconde request avec les informations de l'utilisateur dans lequel j'envoie le cookie d'auth

            console.log('response', response);
            if (response.ok) {
                // fetch les informations du user connecté et vérifie que sa session est toujours en cours
                try {
                    const response = await fetch('http://decitrephpbackend/src/userRoutes/getOneUser.php', {
                        Credentials: 'include'
                    });
                    const user = await response.json();
                    console.log("user", user);
                } catch (error) {
                    console.error("Error while fetching user's data ", error);
                }
                // navigate("/checkout/cart"); 
            } else {
                const errorMessage = await response.text();
                if (errorMessage === 'No matching account') {
                    // proposer la création de compte
                    console.log(errorMessage);
                } else {
                    // gérer les erreurs de frappe
                    console.log(errorMessage);
                }
            }
        } catch (error) {
            console.error('Error during authentication: ', error);
        }
    }


    return (
        <main className='login'>
            <p className='login__welcome breadcrumb'>Connexion</p>
            <section className='login__connexion'>
                <aside className='login__asides'>
                    <h3 className='login__titles'>Vous avez déjà un compte ?</h3>
                    <form className='login__form' onSubmit={handleSubmit} >
                        <span>
                            <label htmlFor='email'>Adresse mail</label>
                            <input id='email' type='email' ref={emailRef} />
                            <label htmlFor='password'>Mot de passe</label>
                            <input id='password' type='password' ref={passwordRef} />
                        </span>
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