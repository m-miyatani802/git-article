import './bootstrap';

import Alpine from 'alpinejs';
// import Vue from 'vue';

window.Alpine = Alpine;

// Alpine.start();

//        // ① ドロップダウンを表示するVueコンポーネントを定義
//        const dropdownNavItemComponent = {
//         props: ['items'],
//         computed: {
//             hasItem() {

//                 return (
//                     Object.keys(this.items).length > 0 &&
//                     this.items.data.length > 0
//                 );

//             }
//         },
//         template: `
//         <li class="nav-item dropdown" v-if="hasItem">
//             <a style="position:relative;min-width:40px;" class="nav-link" data-toggle="dropdown" href="#">
//                 <slot>
//                     <i class="far fa-bell"></i>
//                 </slot>
//                 <span style="position:absolute;top:0;left:16px;" class="badge badge-danger" v-text="items.total"></span>
//             </a>
//             <div style="width:300px;" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
//                 <a style="overflow: hidden;text-overflow:ellipsis;" class="dropdown-item" :href="item.url" v-for="item in items.data">
//                     <small class="float-right text-muted pl-3" v-text="item.date"></small>
//                     <small v-text="item.title"></small>
//                 </a>
//                 <footer>
//                     <slot name="footer"></slot>
//                 </footer>
//             </div>
//         </li>
//     `
//     };

//     Vue.createApp({
//             data() {
//                 return {
//                     announcements: {}
//                 }
//             },
//             mounted() {
//                 // const url = '{{ route('announcement.list') }}';
//                 const url = 'http://localhost/announcement/list';
//                 axios.get(url)
//                     .then(response => {

//                         this.announcements = response.data;

//                     });
//             }
//         })
//         .component('v-dropdown-nav-item', dropdownNavItemComponent) // ② コンポーネントをセット
//         .mount('#app');
