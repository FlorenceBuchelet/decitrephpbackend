import { Link, useOutletContext } from "react-router-dom";
import CartBreadcrumb from "../../../components/CartBreadcrumb/CartBreadcrumb";
import "./Identification.scss";
import { useEffect, useState } from "react";

function Identification() {
    const [cartContent, setCartContent] = useState([]);
    const [totalPrice, setTotalPrice] = useState(0);
    const { notification } = useOutletContext();

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

    return (
        <>
            <CartBreadcrumb
                classname={"identification"} />
            <span className="identification__redirect">
                <h3 className="cart__redirect--title">Ma commande</h3>
            </span>
            <span className="identification__cart">
                <p className="identification__estimate">Retrait estimé entre <span className="identification__green">bientôt</span> et <span className="identification__green">très bientôt</span></p>
                <span className="identification__estimate--edit">
                    <Link to={'/checkout/cart'}>
                        <button className="identification__button--back" type="button">Modifier</button>
                    </Link> <p>{notification} articles</p>
                </span>
            </span>
            {/* Cartline */}
            {cartContent.map((product) => (
                    <span className="identification__lines"
                        key={product.cart_product_id}>
                        <p className="identification__title">{product.title}</p>
                        <p className="identification__secondLine"><span className="identification__author">
                            {product.author}
                        </span>
                            <span className="identification__price">{product.promo_price
                                ? (product.promo_price * product.quantity).toFixed(2)
                                : (product.price * product.quantity).toFixed(2)} €</span>
                        </p>
                    </span>
            ))}
            <span className="identification__totalPrice">
                <p className="identification__totalPrice--firstLine"><span>Frais de livraison : </span><span className="identification__price">0,00 €</span></p>
                <p className="identification__totalPrice--secondLine"><span>Total : </span><span className="identification__price">{totalPrice} €</span></p>
            </span>
            <Link to={'/checkout/delivery'}><button className="identification__button--next" type="button">Continuer &gt;</button></Link>
        </>
    );
}

export default Identification;