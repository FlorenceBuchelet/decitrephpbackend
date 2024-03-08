import { Link } from "react-router-dom";
import "./CartBreadcrumb.scss";

function CartBreadcrumb({ classname }) {

    return (
        <p className="cart__breadcrumb">
            <span className={(["cart", "identification", "delivery", "payment", "confirmation"].includes(classname)) ? classname : ""}>
                <Link className="cart__breadcrumb--links" to={'/checkout/cart'}>Mon panier</Link>
            </span>
            <span className={(["identification", "delivery", "payment", "confirmation"].includes(classname)) ? "identification" : ""}>&gt;</span>
            <span className={(["identification", "delivery", "payment", "confirmation"].includes(classname)) ? "identification" : ""}>
                <Link className="cart__breadcrumb--links" to={'/checkout/identification'}>Identification</Link>
                </span>
            <span className={(["delivery", "payment", "confirmation"].includes(classname)) ? "delivery" : ""}>&gt;</span>
            <span className={(["delivery", "payment", "confirmation"].includes(classname)) ? "delivery" : ""}>
            <Link className="cart__breadcrumb--links" to={'/checkout/delivery'}>Livraison</Link>
                </span>
            <span className={(["payment", "confirmation"].includes(classname)) ? "payment" : ""}>&gt;</span>
            <span className={(["payment", "confirmation"].includes(classname)) ? "payment" : ""}>
            <Link className="cart__breadcrumb--links" to={'/checkout/payment'}>Paiement</Link>
                </span>
            <span className={classname === "confirmation" ? "confirmation" : ""}>&gt;</span>
            <span className={classname === "confirmation" ? "confirmation" : ""}>Confirmation</span>
        </p>
    );
}

export default CartBreadcrumb;
