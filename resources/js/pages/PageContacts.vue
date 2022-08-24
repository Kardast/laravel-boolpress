<template>
  <div>
    <h1>Contact us</h1>
    <!-- <form @submit.prevent="submitMessage" novalidate> -->
    <form @submit.prevent="submitMessage">

        <div v-if="successMessage" class="alert alert-success" role="alert">
            {{ successMessage }}
        </div>
        <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
        </div>

        <!-- NAME -->
        <div class="mb-3">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" :class="{'is-invalid': inputsErrorMessages.name}" type="text" name="name" id="name" v-model="name">
            <div class="invalid-feedback">
                <ul>
                    <li v-for="error in inputsErrorMessages.name" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" :class="{'is-invalid': inputsErrorMessages.email}" type="email" name="email" id="email" v-model="email">
            <div class="invalid-feedback">
                <ul>
                    <li v-for="error in inputsErrorMessages.email" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- MESSAGE -->
        <div class="mb-3">
            <label class="form-label" for="Message">Message</label>
            <textarea class="form-control" :class="{'is-invalid': inputsErrorMessages.message}" name="message" id="message" cols="30" rows="10" v-model="message"></textarea>
            <div class="invalid-feedback">
                <ul>
                    <li v-for="error in inputsErrorMessages.message" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- CHECKBOX -->
        <div>
            <input class="form-check-input" :class="{'is-invalid': inputsErrorMessages.newsletter}" type="checkbox" name="newsletter" id="newsletter" v-model="mailinglist">
            <label class="form-check-label" for="newsletter">Iscrivimi alla newsletter</label>
            <div class="invalid-feedback">
                <ul>
                    <li v-for="error in inputsErrorMessages.newsletter" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" :disabled="sending">{{ sending ? 'Sending...' : 'Send' }}</button>
    </form>
  </div>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'PageContacts',
    data() {
        return {
            name: '',
            email: '',
            message: '',
            mailinglist: true,
            successMessage: '',
            errorMessage: '',
            sending: false,
            inputsErrorMessages: {},
        }
    },
    methods: {
        submitMessage() {
            this.sending = true;
            axios.post('/api/leads', {
                name: this.name,
                email: this.email,
                message: this.message,
                mailinglist: this.mailinglist
            })
                .then(res => {
                    console.log(res.data)
                    if (res.data.success) {
                        this.resetForm();
                        this.successMessage = res.data.response;
                    } else {
                        this.inputsErrorMessages = res.data.response;
                    }
                })
                .catch(error => this.errorMessage = 'C\'è stato un errore imprevisto. Riprovare')
                .finally(data => this.sending = false);
        },
        resetForm() {
            this.name = '';
            this.email = '';
            this.message = '';
            this.mailinglist = true;
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
