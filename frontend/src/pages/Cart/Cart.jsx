import CartLine from "../../components/CartLine/CartLine";
import "./Cart.scss";
import { Link } from "react-router-dom";


function Cart() {
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
            <span className="cart__tableHeader cart__tableHeader--top">
                <Link to="/">
                    <button className="cart__button--back">&lt; Poursuivre mes achats</button>
                </Link>
                <span>
                    <p>Total :</p>
                    <p className="cart__total">10,00 €</p>
                    <button className="cart__button--validation">Valider mon panier &gt;</button>
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