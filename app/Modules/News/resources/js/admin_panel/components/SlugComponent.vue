<template>
     <span class="m-form__help" style="float: right;">{{ baseUrl }}/{{lang}}/p/<a href="javascript:;" @click="editSlug" v-if="!showSlugInput">{{slug}}</a>
         <template v-if="showSlugInput">
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
                showSlugInput: false,
                newSlug: '',
                message: '',
                isEdit: false,
                slug: '',
            }
        },
        props: {
            text: null,
            lang: '',
            baseUrl: '',
            page: null,
            slugging: null,
        },
        watch: {
            text: {
                handler(txt) {
                    let textSlugify;

                    if (this.page) { // edit
                        if (this.isEdit) // first edit
                            textSlugify = slugify(txt[this.lang]);
                        else {
                            textSlugify = slugify(this.page.slug);
                            this.isEdit = true;
                        }
                    } else {
                        textSlugify = slugify(txt[this.lang]);
                    }

                    this.slug = textSlugify;
                    this.$emit('update:slugging', textSlugify);
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
                if (this.showSlugInput) {
                    this.showSlugInput = false;
                } else {
                    this.showSlugInput= true;
                }
                this.newSlug = this.slug;
            },
            saveSlug() {
                let newSlugify = slugify(this.newSlug);
                if (newSlugify == '') {
                    this.message = 'Please enter your slug';
                    return;
                }
                this.message = '';
                this.slug = newSlugify;
                this.$emit('slug', newSlugify);
                this.$emit('update:slugging', newSlugify);
                this.showSlugInput = false;                 // hide input new slug
            }
        }
    }
</script>

<style scoped>

</style>
