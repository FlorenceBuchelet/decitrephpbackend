import { useContext, useRef, useState } from 'react';
import './Login.scss';
import { Link, useNavigate } from 'react-router-dom';
import { UserContext } from '../../contexts/userContext';


function Login() {
    const [authError, setAuthError] = useState("");
    const { setUser } = useContext(UserContext);

    const emailRef = useRef();
    const passwordRef = useRef();
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const formData = new FormData();
            formData.append('email', emailRef.current.value);
            formData.append('password', passwordRef.current.value);

            const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/authentication.php`, {
                method: "POST",
                credentials: 'include',
                body: formData,
            });

            if (response.ok) {
                const message = await response.text();
                if (message === 'No matching account') {
                    setAuthError("Votre email et/ou votre mot de passe ne correspondent pas.")
                } else {
                    try {
                        const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/getOneUser.php`, {
                            credentials: 'include'
                        });
                        const fetchedUser = await response.json();
                        setUser(fetchedUser);
                        navigate("/checkout/cart"); 
                    } catch (error) {
                        console.error("Error while fetching user: ", error)
                    }
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