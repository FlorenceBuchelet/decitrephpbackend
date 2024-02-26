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

            if (response.ok) {
                // Lire le cookie
                console.log("cookie", document.cookie);
                const cookie = document.cookie;
                const authCookie = cookie.split(';').find(cookie => cookie.trim().startsWith('auth='));
                const authCookieValue = authCookie ? authCookie.trim().substring(5) : null;
                console.log("authCookieValue", authCookieValue);
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