import axios from 'axios';
const toggleSidebarFilter = ({state}) => {
    state.sidebarFilter = ! state.sidebarFilter;

    $('.sidebar-filter').toggleClass('show');
};

const updateFilterValues = ({commit}, payload) => {
    commit('UPDATE_FILTER_VALUES', payload);
};

const selectAllRows = ({commit}, payload) => {
    commit('SELECT_ALL_ROWS', payload);
};

const selectTableRow = ({commit}, payload) => {
    commit('SELECT_TABLE_ROW', payload);
};

const updateTableData = ({state}, payload) => {
    state.tableData = payload;
};

const fetchConversations = async ({state, commit}) => {
    try {
        const data = await axios.get("/admin/chat/conversations/fetch").then(res => res.conversations);
        console.log(data);
        commit("FETCH_CONVERSATIONS", data)
    } catch (error) {
        alert(error);
        console.log(error);
    }
}

export default {
    toggleSidebarFilter,
    updateFilterValues,
    selectAllRows,
    selectTableRow,
    updateTableData,
    fetchConversations,
};
