import { useEffect, useState } from "react";
import CartLine from "../../components/CartLine/CartLine";
import "./Cart.scss";
import { Link, useNavigate } from "react-router-dom";


function Cart() {
    const navigate = useNavigate();
    const [cartContent, setCartContent] = useState([]);

    // Ici il faut fetch le cart du user
    // mettre à jour un tableau d'objets avec ce qu'il contient
    // map ce tableau
    // quand le user clique sur "ajouter au panier", le panier dans sa session est updaté

    useEffect(() => {
        const userInfo = async () => {

            try {
                const response = await fetch('http://decitrephpbackend/src/userRoutes/getOneUser.php', {
                    credentials: 'include'
                });
                console.log("cart fetch response", response);
                const user = await response.json();
                console.log("user", user);
            } catch (error) {
                console.error("Error while fetching user's data ", error);
            }
        }
        userInfo();
    }, [])

    const handleClick = async () => {
        try {
            const response = await fetch('http://decitrephpbackend/src/userRoutes/disconnect.php');
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
            <span className="cart__tableHeader cart__tableHeader--top">
                <Link to="/">
                    <button className="cart__button--back">&lt; Poursuivre mes achats</button>
                </Link>
                <span>
                    <p>Total :</p>
                    <p className="cart__total">10,00 €</p>
                    <button type="button"className="cart__button--validation">Valider mon panier &gt;</button>
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
                    <tr>
                        <CartLine />
                    </tr>
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
        </main>
    );
}

export default Cart;