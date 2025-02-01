// ******

// ******
// Code (c) Kieran Metcalfe / Ascent Creative 2021
$.ascent = $.ascent?$.ascent:{};

var BibleRefTokens = {

    // Default options.
	options: {
        value: null,
        fieldName: 'tags',
        labelField: 'title',
        allowNewValues: true,
        source: null
    },

    _init: function () {

        var self = this;
        
        val = this.options.value;

        //this.element.val('');

        this.element.wrap('<DIV class="biblereftokens form-control p-2 bg-light"></DIV>');

        this.element = this.element.parents('.biblereftokens');

        for($iTkn = 0; $iTkn < val.length; $iTkn++) {
            this.addToken(val[$iTkn]); // no validation as we're just loading pre-validated values
        }

        this.element.on('click', 'A.rt_remove', function() {
            $(this).parents('.rt_token').remove();
            self.updateFieldIndexes();
        });


        // uses keyup rather than down so the e ventr fires after the autocomplete select callback 
        // if needed. That means the field is empty and the addToken will return and not add a second token
        this.element.find("INPUT[type=text]").on('keyup', function(e) {

            var breaks = [9,13,188];

            if(breaks.includes(e.which)) {
                self.validateAndAddToken($(this).val());
                e.preventDefault();
            }

        });

    },

    validateAndAddToken: function(bibleref) {

        let self = this;
        let fld = $(this.element).find('.item-entry');


        // // check if token exits. Don't allow duplicates.
        // // NB - this could be a duplicate of a new value (null id), or not.
        // // might be best to check on label value.
        // let dupe = false;
        // this.element.find(".rt_token .token-label").each(function (idx) {
        //     if($(this).val() == bibleref) {
        //         alert("That item has already been added.");
        //         dupe = true;
        //         return;
        //     }
        // });

        // if(dupe)
        //     return;

        // fire the value off to the server prior to actually creating the token:
        $.get('/bibleref/parse/' + $(fld).val(), 
                    
            function(data) {
                console.log(data);
                //var result = $.parseJSON(data);
                if (data['result'] == 'error') {
                    alert(data['message']);
                } else if (data['result'] == 'ok') {
                    self.addToken(data['data']);
                    $(fld).val('');
                }
                            
            }
                    
        );
         
    },

    addToken: function (data) {
        
        var idx = this.element.find('.rt_token').length;

        token = '<div class="rt_token">';
        token += data['ref'];

        for(item in data) {
            token += '<input type="hidden" class="token-label" name="' + this.options.fieldName + '[' + idx + '][' + item + ']" value="' + data[item] + '">';
        }

        token += '<A href="#delete-token" class="bi-x-square-fill text-danger rt_remove"></A>';
        token += '</div>';

        // console.log(token);

        this.element.find('input.item-entry').before(token);

        // this.element.find('input.item-entry').val(''); //.autocomplete('close');

    },

    updateFieldIndexes: function() {

        var fldname = this.options.fieldName;

        console.log('UFI', fldname);

        // reapply field indexes to represent reordering
        $(this.element).find('.rt_token').each(function(idx) {

            var prefix = fldname + "[" + idx + "]";

            $(this).find('INPUT').each(function(fldidx) {

                esc = fldname.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

                re = new RegExp(esc + "\\[\\d+\\]");
                
                this.name = this.name.replace(re, prefix);   
                
            });

        });

        // $(this.element).trigger('change');

        
    }   

}

$.widget('ascent.biblereftokens', BibleRefTokens);
$.extend($.ascent.BibleRefTokens, {
		 
		
}); 

$(document).ready(function(){
   // $('.cms-relatedtokens').relatedtokens();
});