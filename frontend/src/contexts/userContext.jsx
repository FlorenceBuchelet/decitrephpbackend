import { createContext, useMemo, useState } from "react";
import PropTypes from "prop-types";

export const UserContext = createContext();

export function UserProvider({ children }) {
    const [user, setUser] = useState([{}]);
    const [phpsessid, setPhpsessid] = useState("");
    const authUser = useMemo(() => ({ user, setUser, phpsessid, setPhpsessid }), [user, setUser, phpsessid, setPhpsessid]);

    return <UserContext.Provider value={authUser}>{children}</UserContext.Provider>;
}

UserProvider.propTypes = {
    children: PropTypes.oneOfType([
        PropTypes.arrayOf(PropTypes.node),
        PropTypes.shape({}),
        PropTypes.node,
    ]).isRequired,
};