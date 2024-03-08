import { useContext, useEffect, useState } from "react";
import CartLine from "../../components/CartLine/CartLine";
import "./Cart.scss";
import { Link, useNavigate, useOutletContext } from "react-router-dom";
import { UserContext } from "../../contexts/userContext";
import CartBreadcrumb from "../../components/CartBreadcrumb/CartBreadcrumb";

function Cart() {
    const navigate = useNavigate();
    const [cartContent, setCartContent] = useState({});
    const [totalPrice, setTotalPrice] = useState(0);
    const { user, setUser } = useContext(UserContext);
    const { setNotification } = useOutletContext();

    useEffect(() => {
        const getCart = async () => {
            try {
                const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/getCart.php`, {
                    credentials: 'include'
                });
                const cart = await response.json();
                setCartContent(cart);
            } catch (error) {
                console.error("Error while fetching user's data: ", error);
            }
        }
        const getCartTotalPrice = async () => {
            try {
                const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/getCartTotalPrice.php`, {
                    credentials: 'include'
                });
                const cartTotalPrice = await response.json();
                setTotalPrice(cartTotalPrice);
            } catch (error) {
                console.error("Error while fetching total: ", error);
            }
        }
        getCart();
        getCartTotalPrice();
    }, [])

    const handleDisconnect = async () => {
        try {
            const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/disconnect.php`, {
                credentials: 'include'
            });
            const textResponse = await response.text();
            if (textResponse === "disconnected") {
                setUser([{}]);
                setNotification(0);
                navigate('/');
            }
        } catch (error) {
            console.error("Error in disconnection: ", error);
        }
    }

    const handleEmptyCart = async () => {
        try {
            const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/emptyCart.php`, {
                credentials: 'include'
            });
            const cart = await response.json();
            setCartContent(cart);
        } catch (error) {
            console.error("Error while emptying the cart: ", error);
        }
        window.location.reload();
    }

    const handleValidate = () => {
        user[0].user_id
        ? navigate('/checkout/identification')
        : navigate("/customer/account/login");
    }

    return (
        <main className="cart">
            <CartBreadcrumb
                classname={"cart"} />
            <span className="cart__headerButtons">
                <button onClick={handleEmptyCart} className="cart__emptyCart">Vider le panier</button>
                <button onClick={handleDisconnect} className="cart__disconnect">Déconnexion</button>
            </span>
            {Object.keys(cartContent).length > 0 ? <>
                <span className="cart__tableHeader cart__tableHeader--top">
                    <Link to="/">
                        <button className="cart__button--back">&lt; Poursuivre mes achats</button>
                    </Link>
                    <span>
                        <p>Total :</p>
                        <p className="cart__total">{totalPrice} €</p>
                        <button type="button" onClick={handleValidate} className="cart__button--validation">Valider mon panier &gt;</button>
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
                        {Object.keys(cartContent).map(key => {
                            const product = cartContent[key];
                            return (
                                <CartLine
                                    key={product.product.productId}
                                    productId={product.product.productId}
                                    image={product.product.image}
                                    title={product.product.title}
                                    author={product.product.author}
                                    price={product.product.price}
                                    promoPrice={product.product.promoPrice}
                                    quantity={product.quantity}
                                />
                            )
                        })}
                    </tbody>
                </table>
                <span className="cart__tableHeader">
                    <Link to="/">
                        <button className="cart__button--back">&lt; Poursuivre mes achats</button>
                    </Link>
                    <span>
                        <p>Total :</p>
                        <p className="cart__total">{totalPrice} €</p>
                        <button type="button" onClick={handleValidate} className="cart__button--validation">Valider mon panier &gt;</button>
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