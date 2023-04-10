import {
    mdiAccountCircle,
    mdiMonitor,
    mdiGithub,
    mdiLock,
    mdiAlertCircle,
    mdiSquareEditOutline,
    mdiTable,
    mdiViewList,
    mdiTelevisionGuide,
    mdiResponsive,
    mdiPalette,
    mdiShapeOutline,
    mdiPiggyBankOutline,
} from "@mdi/js";

export default [
    {
        route: "dashboard",
        icon: mdiMonitor,
        label: "Dashboard",
    },
    {
        route: "accounts.index",
        icon: mdiPiggyBankOutline,
        label: "Accounts",
    },
    {
        route: "categories.index",
        icon: mdiShapeOutline,
        label: "Categories",
    },
    {
        route: "tables",
        label: "Tables",
        icon: mdiTable,
    },
    {
        route: "forms",
        label: "Forms",
        icon: mdiSquareEditOutline,
    },
    {
        route: "ui",
        label: "UI",
        icon: mdiTelevisionGuide,
    },
    // {
    //   route: "/",
    //   label: "Styles",
    //   icon: mdiPalette,
    // },
    {
        route: "profile",
        label: "Profile",
        icon: mdiAccountCircle,
    },
    {
        route: "login",
        label: "Login",
        icon: mdiLock,
    },
    {
        route: "error",
        label: "Error",
        icon: mdiAlertCircle,
    },
    {
        label: "Dropdown",
        icon: mdiViewList,
        menu: [
            {
                label: "Item One",
            },
            {
                label: "Item Two",
            },
        ],
    }
];
