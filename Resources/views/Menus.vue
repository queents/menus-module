<template>
    <Container>
        <template #header>
            <Header :title="title">
                <a @click.prevent="goBack()"
                    v-if="Object.keys(selectedMenu).length || Object.keys(selectedMenuItem).length" class="
                    filament-button
                    inline-flex
                    items-center
                    justify-center
                    py-1
                    gap-1
                    font-medium
                    rounded-lg
                    border
                    transition-colors
                    focus:outline-none
                    focus:ring-offset-2
                    focus:ring-2
                    focus:ring-inset
                    dark:focus:ring-offset-0
                    min-h-[2.25rem]
                    px-4
                    text-sm
                    text-white
                    shadow
                    focus:ring-white
                    border-transparent
                    bg-primary-600
                    hover:bg-primary-500
                    focus:bg-primary-700
                    focus:ring-offset-primary-700
                    filament-page-button-action" href="#">
                    <i class="bx bx-arrow-back" style="font-size: 20px"></i>
                    <span class="">
                        {{ back }}
                    </span>
                </a>
            </Header>
        </template>
        <template #body>
            <div
                class="bg-white border border-gray-300 shadow-sm rounded-xl filament-tables-container dark:bg-gray-800 dark:border-gray-700">
                <div v-for="(item, key) in menu" :key="key" @click.prevent="setMenu(item, key)">
                    <div v-if="!Object.keys(selectedMenu).length"
                        class="w-full p-4 my-auto font-bold capitalize border-b cursor-pointer">
                        <span>{{ key }}</span>
                    </div>
                </div>
                <draggable v-if="!Object.keys(selectedMenuItem).length" :list="selectedMenu" @change="log">
                    <div v-for="(group, index) in selectedMenu" :key="index"
                        class="items-center w-full p-4 font-bold capitalize border-b cursor-move py-auto">
                        <div class="flex justify-between">
                            <div class="my-auto"><span>{{ group.label }}</span></div>
                            <div>
                                <button @click.prevent="setMenuItem(index)" class="
                                        filament-button
                                        inline-flex
                                        items-center
                                        justify-center
                                        py-1
                                        gap-1
                                        font-medium
                                        rounded-lg
                                        border
                                        transition-colors
                                        focus:outline-none
                                        focus:ring-offset-2
                                        focus:ring-2
                                        focus:ring-inset
                                        dark:focus:ring-offset-0
                                        min-h-[2.25rem]
                                        px-4
                                        text-sm
                                        text-white
                                        shadow
                                        focus:ring-white
                                        border-transparent
                                        bg-primary-600
                                        hover:bg-primary-500
                                        focus:bg-primary-700
                                        focus:ring-offset-primary-700
                                        filament-page-button-action">
                                    <i class="bx bx-edit"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </draggable>
                <draggable v-else :list="selectedMenuItem.menu" @change="log">
                    <div v-for="(menuItem, index) in selectedMenuItem.menu" :key="index"
                        class="items-center w-full p-4 font-bold capitalize border-b cursor-move py-auto">
                        <span>{{ menuItem.name.replaceAll('_', ' ') }}</span>
                    </div>
                </draggable>
            </div>
        </template>
    </Container>
</template>

<script>
import AppLayout from "@@/Layouts/AppLayout.vue";
import Container from "@@/Components/Container.vue";
import Header from "@@/Layouts/Includes/Header.vue";
import { VueDraggableNext } from 'vue-draggable-next';

export default {
    layout: AppLayout,
    props: {
        menu: {
            Object
        },
        title: {
            String
        },
        back: {
            String
        }
    },
    data() {
        return {
            selectedMenu: {},
            selectedMenuName: "",
            selectedMenuItem: {}
        }
    },
    components: {
        Container,
        Header,
        draggable: VueDraggableNext
    },
    methods: {
        setMenu(item, key) {
            this.selectedMenuName = key;
            let itemArray = [];
            for (let i = 0; i < Object.keys(item).length; i++) {
                itemArray.push(item[Object.keys(item)[i]]);
            }
            this.selectedMenu = itemArray;
        },
        setMenuItem(index) {
            this.selectedMenuItem = this.selectedMenu[index];
        },
        goBack() {
            this.selectedMenu = {};
            this.selectedMenuName = "";
            this.selectedMenuItem = {};
        },
        log(event) {
            axios.post(route('menus.move'), {
                name: this.selectedMenuName,
                menu: this.selectedMenu
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
        },
    }
}
</script>
