import { useContext } from "react";
import "./ProductProfile.scss";
import { ProfileProductContext } from "../../contexts/profileProductContext";
import handleOrder from "../../services/handleOrder";

function ProductProfile() {
    const { profileProduct } = useContext(ProfileProductContext);

    return (
        <>
            {profileProduct[0].product_id ?
                <article className="productProfile">
                    <aside className="productProfile__cover">
                        <img src={profileProduct[0].image} />
                    </aside>
                    <aside className="productProfile__content">
                        <h2>{profileProduct[0].title}</h2> {/* <p>- {type}</p> */}
                        <h3>{profileProduct[0].author}</h3>
                        <p>Quantité en stock : {profileProduct[0].quantity}</p>
                        {/* <p>{summary}</p> */}
                        {profileProduct[0].promo_price ?
                            <>
                                <p className='productProfile__prices productProfile__prices--old'><s>{`${profileProduct[0].price} €`}</s></p>
                                <p className='productProfile__prices productProfile__prices--promo'>{`${profileProduct[0].promo_price} €`}</p>
                            </>
                            :
                            <p className='productProfile__prices productProfile__prices--current'>{`${profileProduct[0].price} €`}</p>
                        }
                        <p>EAN : {profileProduct[0].ean}</p>
                        <button
                            onClick={() => handleOrder(profileProduct[0].product_id)}
                            className="productProfile__button"
                            type="button"
                        >
                            Commander
                        </button>
                    </aside>
                </article>
                : ""}
        </>
    );
}

export default ProductProfile;
