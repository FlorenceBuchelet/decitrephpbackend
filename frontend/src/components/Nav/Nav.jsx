import { Link, useNavigate } from "react-router-dom";
import "./Nav.scss";
import { useContext, useRef, useState } from "react";
import { ProfileProductContext } from "../../contexts/profileProductContext";
import PropTypes from "prop-types";
import { UserContext } from "../../contexts/userContext";

function Nav() {
    const [researchBody, setResearchBody] = useState("");
    const [nbrResearch, setNbrResearch] = useState(1);
    const [customHeader, setCustomHeader] = useState("");
    const [searchArray, setSearchArray] = useState([]);
    const searchRef = useRef();

    const { setProfileProduct } = useContext(ProfileProductContext);
    const { user } = useContext(UserContext);

    const navigate = useNavigate();

    const handleSearchUpdate = async (e) => {
        e.preventDefault();
        try {
            const formData = new FormData();
            formData.append('research', researchBody);
            formData.append('nbr_research', nbrResearch);

            const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/searchRoutes/addSearch.php`, {
                method: "POST",
                headers: {
                    'Specificity': customHeader
                },
                body: formData,
            });

            if (response.ok) {
                console.info('Updated research table');
            } else {
                console.error('Failed to update research table:', response);
            }
            // Reset values after update
            searchRef.current.value = "";
            setResearchBody("");
            setNbrResearch(1);
            setCustomHeader("");
            try {
                const response = await fetch(
                    `${import.meta.env.VITE_BACKEND_URL}src/productRoutes/getOneProduct.php?productId=${encodeURIComponent(searchArray[0].product_id)}`
                );
                const product = await response.json();
                setProfileProduct(product);
            } catch (error) {
                console.error("Error in finding specific product: ", error);
            }

            navigate("/pages");
            setSearchArray([]);
        } catch (error) {
            console.error('Error updating research:', error);
        }
    };

    const handleSearch = async (e) => {
        try {
            const response = await fetch(
                `${import.meta.env.VITE_BACKEND_URL}src/searchRoutes/autocomplete.php?search=${encodeURIComponent(e.target.value)}`
            );
            const search = await response.json();
            setSearchArray(search);
        } catch (error) {
            console.error("Error in autocomplete: ", error);
        }

        // update the state on change
        setResearchBody(e.target.value);
        // Search the element in the array 
        const found = searchArray.find(element => element.research === e.target.value);
        if (!found) {
            setCustomHeader('addSearch');
        } else {
            setNbrResearch(found.nbr_research + 1);
            setCustomHeader('updateSearch');
        }
    }


    return (
        <nav className="nav__container">
            <Link to="/">
                <img src={`${import.meta.env.VITE_BACKEND_URL}/public/images/logo.png`} alt="Decitre, librairie en ligne, achat et vente de livres" />
            </Link>
            <span>
                <form onSubmit={handleSearchUpdate}>
                    <img src={`${import.meta.env.VITE_BACKEND_URL}/public/images/search.png`} />
                    <input
                        onChange={handleSearch}
                        list="searchList"
                        type="search"
                        placeholder="Rechercher un livre, un auteur, une collection..."
                        ref={searchRef} />
                    <datalist id="searchList" className="nav__searchList">
                        {searchArray.map((search) => (
                            <option
                                className="nav__searchList--options"
                                key={search.research_id}
                                value={`${search.research}`}
                            >{search.research}</option>
                        ))}
                    </datalist>
                    <button type="submit">OK</button>
                </form>
                <p>Accès à : <Link to="/">decitrepro.fr</Link></p>
            </span>
            <section className="nav__menus">
                <Link to={user[0]?.user_id ? '/customer/account/' : '/customer/account/login'} className="nav__menus--links">
                    <img src={`${import.meta.env.VITE_BACKEND_URL}/public/images/user.png`} alt="Mon compte" />
                    <p>Mon&nbsp;compte</p>
                </Link>
                <Link to="/pages" className="nav__menus--links">
                    <img src={`${import.meta.env.VITE_BACKEND_URL}/public/images/shops.png`} alt="Nos librairies" />
                    <p>Nos&nbsp;librairies</p>
                </Link>
                <Link to="/checkout/cart" className="nav__menus--links">
                    <p className="nav__notification">1</p>
                    <img src={`${import.meta.env.VITE_BACKEND_URL}/public/images/cart.png`} alt="Mon panier" />
                    <p>Mon&nbsp;panier</p>
                </Link>
            </section>
        </nav>
    );
}

export default Nav;

Nav.propTypes = {
    searchArray: PropTypes.arrayOf(
        PropTypes.shape({
            research: PropTypes.string.isRequired,
            nbr_research: PropTypes.number,
        })
    )
};
