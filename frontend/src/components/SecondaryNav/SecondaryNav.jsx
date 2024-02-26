import { Link } from "react-router-dom";
import "./SecondaryNav.scss";

function SecondaryNav() {
    return (
        <nav className="secondaryNav__container">
            <ul className="secondaryNav__list">
                <Link to="/pages">Livres</Link>
                <Link to="/pages">Nouveautés</Link>
                <Link to="/pages">Coups de coeur</Link>
                <Link to="/pages">Livres à prix réduits</Link>
                <Link to="/pages">Bons plans</Link>
                <Link to="/pages">Ebooks & liseuses</Link>
                <Link to="/pages">Jeux de société</Link>
                <Link to="/pages">Reprise de livres</Link>
            </ul>
            <Link to="/" className="secondaryNav__banner" />
        </nav>
    );
}

export default SecondaryNav;