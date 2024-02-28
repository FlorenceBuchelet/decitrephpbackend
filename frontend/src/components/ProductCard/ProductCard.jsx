import { useContext } from "react";
import "./ProductCard.scss";
import { Link } from "react-router-dom";
import { ProfileProductContext } from "../../contexts/profileProductContext";
import PropTypes from "prop-types";
import handleOrder from "../../services/handleOrder";

function ProductCard({ id, ean, title, image, author, price, promo }) {
    const { setProfileProduct } = useContext(ProfileProductContext);

    return (
        <article className="productCard">
            <Link to="/pages"
                onClick={() => setProfileProduct([{
                    "id": id,
                    "ean": ean,
                    "title": title,
                    "image": image,
                    "author": author,
                    "price": price,
                    "promo": promo
                }])}
                className="productCard" >
                <img src={image} />
                <p className="productCard__title">{title}</p>
                <p className="productCard__author">{author}</p>
                <p className="productCard__price">{price} €</p>
            </Link >
            <button onClick={() => handleOrder(id)} type="button" className="productCard__order">Commander</button>
        </article>
    );
}

export default ProductCard;

ProductCard.propTypes = {
    id: PropTypes.number,
    ean: PropTypes.number.isRequired,
    title: PropTypes.string.isRequired,
    image: PropTypes.string.isRequired,
    author: PropTypes.string.isRequired,
    price: PropTypes.number.isRequired,
    promo: PropTypes.number
};