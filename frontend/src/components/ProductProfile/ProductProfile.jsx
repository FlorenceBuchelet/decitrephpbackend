import { useContext } from "react";
import "./ProductProfile.scss";
import { ProfileProductContext } from "../../contexts/profileProductContext";

function ProductProfile() {
    const { profileProduct } = useContext(ProfileProductContext);

    return (
        <>
            {profileProduct[0] ?
                <article className="productProfile">
                    <aside className="productProfile__cover">
                        <img src={profileProduct[0].image} />
                    </aside>
                    <aside className="productProfile__content">
                        <h2>{profileProduct[0].title}</h2> {/* <p>- {type}</p> */}
                        <h3>{profileProduct[0].author}</h3>
                        {/* <p>Note moyenne {note} */}
                        {/* <p>{summary}</p> */}
                        <p>{profileProduct[0].price} €</p>
                        <p>EAN : {profileProduct[0].ean}</p>
                        <button className="productProfile__button" type="button">Commander</button>
                    </aside>
                </article>
                : "Loading"}
        </>
    );
}

export default ProductProfile;