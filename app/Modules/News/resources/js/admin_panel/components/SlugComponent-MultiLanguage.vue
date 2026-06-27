<template>
     <span class="m-form__help" style="float: right;">
         {{ baseUrl }} /
         <a @click="editSlug" href="javascript:;" v-if="!showSlugInput[lang]"> {{ slug[lang] }}</a>
         <template v-if="showSlugInput[lang]">
             <input @keyup.enter="saveSlug" type="text" v-model="newSlug">
         </template>
         <br>
        <span class="form-control-feedback" style="margin-left: 102px;" v-if="message">{{message}}</span>
     </span>
</template>

<script>
    export default {
        data() {
            return {
                showSlugInput: languages(false),
                newSlug: '',
                message: '',
                isEdit: false,
                slug: languages(),
            }
        },
        props: {
            text: null,
            lang: '',
            baseUrl: '',
            page: null
        },
        watch: {
            text: {
                handler(txt) {
                    let textSlugify;

                    if (this.page) { // edit
                        if (this.isEdit) // first edit
                            textSlugify = slugify(txt[this.lang]);
                        else {
                            textSlugify = slugify(this.page.slug[this.lang]);
                            this.isEdit = true;
                        }
                    } else {
                        textSlugify = slugify(txt[this.lang]);
                    }

                    this.slug[this.lang] = textSlugify;
                },
                deep: true,
            },
        },
        /* computed: {
             slug:  {
                 get: function () {
                    return 'daads';
                 },
                 set: function (newValue) {
                    /// console.log(newValue);
                     this.newSlug =  newValue;
                 }
             }
         },*/
        methods: {
            editSlug() {
                if (this.showSlugInput[this.lang]) {
                    this.showSlugInput[this.lang] = false;
                } else {
                    this.showSlugInput[this.lang] = true;
                }
                this.newSlug = this.slug[this.lang];
            },
            saveSlug() {
                let newSlugify = slugify(this.newSlug);
                if (newSlugify == '') {
                    this.message = 'Please enter your slug';
                    return;
                }
                this.message = '';
                this.slug[this.lang] = newSlugify;
                this.$emit('slug', newSlugify);
                this.showSlugInput[this.lang] = false;                 // hide input new slug
            }
        }
    }
</script>

<style scoped>

</style>
