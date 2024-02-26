import { useContext } from "react";
import "./ProductCard.scss";
import { Link } from "react-router-dom";
import { ProfileProductContext } from "../../contexts/profileProductContext";
import PropTypes from "prop-types";

function ProductCard({ key, ean, title, image, author, price, promo }) {
    const { setProfileProduct } = useContext(ProfileProductContext);

    return (
        <Link to="/pages"
            onClick={() => setProfileProduct([{
                "id": key,
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
            <button type="button" className="productCard__order">Commander</button>
        </Link >
    );
}

export default ProductCard;

ProductCard.propTypes = {
    key: PropTypes.number,
    ean: PropTypes.number.isRequired,
    title: PropTypes.string.isRequired,
    image: PropTypes.string.isRequired,
    author: PropTypes.string.isRequired,
    price: PropTypes.number.isRequired,
    promo: PropTypes.number
};