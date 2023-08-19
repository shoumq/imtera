<template>
    <div>
        <Header></Header>

        <main class="container">
            <a class="main_title">Ответы на вопросы</a>

            <div class="window" style="padding-inline: 40rem" :style="{paddingTop: paddingTop + 'rem', paddingBottom: paddingBottom + 'rem'}">
                <div class="window_title">Ответы на вопросы</div>
                <div class="gaonutosal">
                    <div class="pesontedan" v-for="(item, index) in answers" :key="index">
                        <input :id="'pesontedan-' + item.id" type="checkbox" name="pesontedans">
                        <label :for="'pesontedan-' + item.id">{{ item.title }}</label>
                        <div class="pesontedan-content">
                            <p>{{ item.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>


<script>
import Header from "@/Components/Header.vue";

export default {
    name: 'Welcome',
    props: ['answers', 'options'],
    data() {
        return {
            paddingTop: '',
            paddingBottom: '',
        }
    },
    components: {
        Header
    },
    mounted() {
        this.paddingTop = this.options.padding_top
        this.paddingBottom = this.options.padding_bottom
    }
}
</script>
