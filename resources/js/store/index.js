import Vue from "vue";
import Vuex from 'vuex';
import router from '../routes'

Vue.use(Vuex);

const store = new Vuex.Store({
    namespaced: true,
    state: {
        // todos: [
        //     { id: 1, text: '...', done: true },
        //     { id: 2, text: '...', done: false }
        // ]
        message: 'Welcome, Buddy !',
        userData: {},
        authenticated: false
    },
    getters: {
        // doneTodos: state => {
        //     return state.todos.filter(todo => todo.done)
        // }
        getMessage(state){
            return state.message;
        },
        getUser: state => {
            return state.userData;
        },
        getAuthenticated: state => {
            return state.authenticated;
        }
    },

    mutations: {
        SET_USER (state, data) {
            state.userData = data;
        },
        SET_AUTHENTICATED (state, data) {
            state.authenticated = data;
        }
    },
    actions: {
        authUser({ commit, dispatch }) {
            console.log('hello', commit);
            return axios.get('/api/user').then((response) => {
                commit('SET_AUTHENTICATED', true)
                commit('SET_USER', response.data)
                localStorage.setItem("auth", true);
                
                if(router.currentRoute.name !== null){
                    router.push({ name: 'dashboard' })
                };  

            }).catch(() => {
                commit('SET_AUTHENTICATED', false)
                commit('SET_USER', null)
                localStorage.removeItem("auth");

                if(router.currentRoute.name !== 'login'){
                    router.push({ name: 'login' })
                };
            })
        },
    }
});

export default store;