import { createContext, useMemo, useState } from "react";
import PropTypes from "prop-types";

export const UserContext = createContext();

export function UserProvider({ children }) {
    const [user, setUser] = useState([{}]);
    const authUser = useMemo(() => ({ user, setUser }), [user, setUser]);

    return <UserContext.Provider value={authUser}>{children}</UserContext.Provider>;
}

UserProvider.propTypes = {
    children: PropTypes.oneOfType([
        PropTypes.arrayOf(PropTypes.node),
        PropTypes.shape({}),
        PropTypes.node,
    ]).isRequired,
};