import { useEffect, useState } from "react";
import CartLine from "../../components/CartLine/CartLine";
import "./Cart.scss";
import { Link, useNavigate } from "react-router-dom";

function Cart() {
    const navigate = useNavigate();
    const [cartContent, setCartContent] = useState([]);

    // doit fetch la session chaque fois qu'elle est updatée : à l'affichage de la page, au changement de quantité d'un produit

    useEffect(() => {
        const userInfo = async () => {

            try {
                const response = await fetch('http://decitrephpbackend/src/productRoutes/getCart.php', {
                    credentials: 'include'
                });
                const cart = await response.json();
                setCartContent(cart);
            } catch (error) {
                console.error("Error while fetching user's data ", error);
            }
        }
        userInfo();
    }, [])

    const handleClick = async () => {
        try {
            const response = await fetch('http://decitrephpbackend/src/userRoutes/disconnect.php', {
                credentials: 'include'
            });
            const textResponse = await response.text();
            if (textResponse === "disconnected") {
                navigate('/');
            }
        } catch (error) {
            console.error("Error: ", error)
        }
    }

    return (
        <main className="cart">
            <p className="cart__breadcrumb">
                <span>Mon panier</span>
                <span>&gt;</span>
                <span>Identification</span>
                <span>&gt;</span>
                <span>Livraison</span>
                <span>&gt;</span>
                <span>Paiement</span>
                <span>&gt;</span>
                <span>Confirmation</span>
            </p>
            <button onClick={handleClick} className="cart__disconnect">Déconnexion</button>
            {cartContent.length > 0 ? <>
                <span className="cart__tableHeader cart__tableHeader--top">
                    <Link to="/">
                        <button className="cart__button--back">&lt; Poursuivre mes achats</button>
                    </Link>
                    <span>
                        <p>Total :</p>
                        <p className="cart__total">10,00 €</p>
                        <button type="button" className="cart__button--validation">Valider mon panier &gt;</button>
                    </span>
                </span>
                <table>
                    <thead>
                        <tr>
                            <td>Produit</td>
                            <td>Quantité</td>
                            <td>Prix total</td>
                        </tr>
                    </thead>
                    <tbody>
                        {cartContent.map((product) => (
                                <CartLine
                                    key={product.product_id}
                                    id={product.product_id}
                                    image={product.image}
                                    title={product.title}
                                    author={product.author}
                                    price={product.price}
                                    promoPrice={product.promo_price}
                                    quantity={product.quantity}
                                />
                        ))}
                    </tbody>
                </table>
                <span className="cart__tableHeader">
                    <Link to="/">
                        <button className="cart__button--back">&lt; Poursuivre mes achats</button>
                    </Link>
                    <span>
                        <p>Total :</p>
                        <p className="cart__total">10,00 €</p>
                        <button className="cart__button--validation">Valider mon panier &gt;</button>
                    </span>
                </span>
            </> :
                <span className="cart__redirect">
                    <h3 className="cart__redirect--title">Retourner sur</h3>
                    <ul className="cart__redirect--list">
                        <li className="cart__redirect--links"><Link to={"/"}>&gt; la page d&apos;accueil</Link></li>
                        <li className="cart__redirect--links"><Link to={"/customer/account"}>&gt; votre compte</Link></li>
                    </ul>
                </span>}
        </main>
    );
}

export default Cart;