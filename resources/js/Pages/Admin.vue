<template>
    <div>
        <Header></Header>

        <main class="container">
            <a class="main_title">Админка</a>

            <div class="admin_window">
                <form @submit.prevent="createAnswer">
                    <div class="admin_title">Создать вопрос</div>
                    <div class="input_div">
                        <input type="text" v-model="title" placeholder="Вопрос">
                        <input type="text" v-model="answer" placeholder="Ответ">
                        <div class="btn_div">
                            <button class="btn" type="submit">Создать</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="admin_window">
                <form @submit.prevent="updateDesign">
                    <div class="admin_title">Дизайн</div>
                    <div class="flex_main">
                        <div>
                            <div class="admin_under--title">Оступы сверху</div>
                            <div class="admin_flex">
                                <a @click="choosePaddingTop" class="pad_text pad_textt" data-padt="10">10px</a>
                                <a @click="choosePaddingTop" class="pad_text pad_textt pad_text--active" data-padt="15">15px</a>
                                <a @click="choosePaddingTop" class="pad_text pad_textt" data-padt="20">20px</a>
                                <a @click="choosePaddingTop" class="pad_text pad_textt" data-padt="25">25px</a>
                            </div>
                        </div>
                        <div>
                            <div class="admin_under--title">Оступы снизу</div>
                            <div class="admin_flex">
                                <a @click="choosePaddingBottom" class="pad_text pad_textb" data-padb="10">10px</a>
                                <a @click="choosePaddingBottom" class="pad_text pad_textb pad_text--active"
                                   data-padb="15">15px</a>
                                <a @click="choosePaddingBottom" class="pad_text pad_textb" data-padb="20">20px</a>
                                <a @click="choosePaddingBottom" class="pad_text pad_textb" data-padb="25">25px</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="admin_window" v-for="(item, index) in answers" :key="index">
                <div>
                    <div class="admin_title">Вопрос №{{ index + 1 }}</div>
                    <div class="input_div">
                        <input type="text" v-model="item.title">
                        <input type="text" v-model="item.answer">
                        <div class="btn_div">
                            <button class="btn" @click="updateAnswer(item.id, item.title, item.answer)">Сохранить
                            </button>
                            <button class="btn-d" @click="deleteAnswer(item.id)">Удалить</button>
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
    name: "Admin",
    props: ['answers', 'options'],
    data() {
        return {
            title: '',
            answer: '',
            paddingTop: '',
            paddingBottom: ''
        }
    },
    components: {
        Header
    },
    methods: {
        createAnswer() {
            axios.post('/api/admin/create_answer', {
                title: this.title,
                answer: this.answer,
            })
                .then((response) => {
                    this.title = ''
                    this.answer = ''
                    this.answers.push(response.data)
                })
        },

        deleteAnswer(id) {
            axios.post('/api/admin/delete_answer', {id})
                .then((response) => {
                    this.answers.splice(this.answers.findIndex(item => item.id === response.data.id), 1)
                })
        },

        updateAnswer(id_field, title_field, answer_field) {
            axios.post('/api/admin/update_answer', {
                id: id_field,
                title: title_field,
                answer: answer_field
            })
        },

        updateDesign() {
            axios.post('/api/admin/update_design', {
                paddingTop: this.paddingTop,
                paddingBottom: this.paddingBottom
            })
                .then((response) => {
                    console.log(response.data)
                })
        },

        choosePaddingTop(event) {
            // Дизайн
            let elPad = document.querySelectorAll('.pad_textt');
            for (let i = 0; i < elPad.length; i++) {
                elPad[i].classList.remove('pad_text--active');
            }
            event.target.classList.add('pad_text--active')

            // Функционал
            axios.post('/api/admin/update_design', {
                paddingTop: event.target.getAttribute('data-padt')
            })
        },

        choosePaddingBottom(event) {
            // Дизайн
            let elPad = document.querySelectorAll('.pad_textb');
            for (let i = 0; i < elPad.length; i++) {
                elPad[i].classList.remove('pad_text--active');
            }
            event.target.classList.add('pad_text--active')

            // Функционал
            axios.post('/api/admin/update_design', {
                paddingBottom: event.target.getAttribute('data-padb')
            })
        }
    },
    mounted() {
        this.paddingTop = this.options.padding_top
        this.paddingBottom = this.options.padding_bottom


        // Оступы сверху
        let elPadTop = document.querySelectorAll('.pad_textt');
        for (let i = 0; i < elPadTop.length; i++) {
            elPadTop[i].classList.remove('pad_text--active');
        }
        for (let i = 0; i < elPadTop.length; i++) {
            if (elPadTop[i].getAttribute('data-padt') === this.paddingTop) {
                elPadTop[i].classList.add('pad_text--active')
            }
        }


        // Оступы снизу
        let elPadBottom = document.querySelectorAll('.pad_textb');
        for (let i = 0; i < elPadBottom.length; i++) {
            elPadBottom[i].classList.remove('pad_text--active');
        }
        for (let i = 0; i < elPadBottom.length; i++) {
            if (elPadBottom[i].getAttribute('data-padb') === this.paddingBottom) {
                elPadBottom[i].classList.add('pad_text--active')
            }
        }
    }
}
</script>
