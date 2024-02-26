import { createContext, useMemo, useState } from "react";
import PropTypes from "prop-types";

export const ProfileProductContext = createContext();

export function ProfileProductProvider({ children }) {
    const [profileProduct, setProfileProduct] = useState([{}]);
    const profile = useMemo(() => ({ profileProduct, setProfileProduct }), [profileProduct, setProfileProduct]);

    return <ProfileProductContext.Provider value={profile}>{children}</ProfileProductContext.Provider>;
}

ProfileProductProvider.propTypes = {
    children: PropTypes.oneOfType([
        PropTypes.arrayOf(PropTypes.node),
        PropTypes.shape({}),
        PropTypes.node,
    ]).isRequired,
};