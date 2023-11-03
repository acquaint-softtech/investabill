var ftozNewRelation = new Vue({
    el: '#ftoz_relation_new',
    data: {
        integrationTitle: '',
        formProviderId: '',
        forms: '',
        formId: '',
        formFields: '',
        formValidated: 0,
        webhookUrl: ''
    },
    methods: {
        changeFormProvider: function(event) {
            this.formValidated  = 1;
            this.formId = '';
            if(this.formProviderId == '') {
                ftozNewRelation.forms = '';
                ftozNewRelation.formValidated = 0;
                return;
            }

            var formProviderData = {
                'action': 'ftoz_get_forms',
                'nonce': ftoz.nonce,
                'formProviderId': this.formProviderId
            };

            jQuery.post( ajaxurl, formProviderData, function( response ) {
                ftozNewRelation.forms         = response.data;
                ftozNewRelation.formValidated = 0;
            });
        }
    },
    watch: {
        listId: function(val) {
            ftozNewRelation.listName = this.zapierLists[val];
        }
    }

});

// ______________________________________________________

var ftozEditRelation = new Vue({
    el: '#ftoz-edit-relation',
    data: {
        integrationTitle: '',
        formProviderId: '',
        forms: '',
        formId: '',
        formFields: '',
        formValidated: 0,
        webhookUrl: ''
    },
    methods: {

    },
    mounted: function() {
        if (typeof integrationTitle !== 'undefined') {
            this.integrationTitle = integrationTitle;
        }

        if (typeof formProvider !== 'undefined') {
            this.formProviderId = formProvider;
        }

        if (typeof forms !== 'undefined') {
            this.forms = forms;
        }

        if (typeof formId !== 'undefined') {
            this.formId = formId;
        }

        if (typeof listId !== 'undefined') {
            this.listId	= listId;
        }

        if (typeof formFields !== 'undefined') {
            this.formFields	= formFields;
        }

        if (typeof webhookUrl !== 'undefined') {
            this.webhookUrl = webhookUrl;
        }

    }
});

jQuery(document).ready(function() {
    jQuery(".relation-delete").on("click", function(e) {
        console.log(ftoz);
        if(confirm(ftoz.delete_confirm)) {
            return;
        } else {
            e.preventDefault();
        }
    });
});