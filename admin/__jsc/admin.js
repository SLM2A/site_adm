$(function() {
    //SHADOWBOX
    //Shadowbox.init();

    //MASCARAS
//    $(".formDate").mask("99/99/9999 99:99:99", {placeholder: " "});
//    $(".formCPF") .mask("999.999.999-99" , {placeholder: ""});
//    $(".formDataMask") .mask("99/99/9999" , {placeholder: ""});

    //TinyMCE
    //EXTENSÂO DE YOUTUBE EM \tiny_mce\plugins\media\js MEDIA.js
    tinyMCE.init({
        // General options
        mode: "specific_textareas",
        editor_selector: "js_editor",
        language: "pt",
        theme: "advanced",
        elements: 'abshosturls',
        relative_urls: false,
        remove_script_host: false,
        skin: "o2k7",
        skin_variant: "silver",
        plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
        theme_advanced_blockformats: "p,h2,h3,h4,pre,address",
        // Theme options
        theme_advanced_buttons1: "fullscreen,|,undo,redo,|,code,|,pastetext,|,removeformat,|,formatselect,bold,italic,underline,|,strikethrough,|,forecolor,backcolor,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,|,link,unlink,|,anchor,|,image,|,media,|,blockquote,|,hr,|,outdent,indent,|,charmap",
        theme_advanced_buttons2: "",
        theme_advanced_buttons3: "",
        theme_advanced_buttons4: "",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "center",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: false,
        // Example content CSS (should be your site CSS)
        content_css: "css/tiny.css",
        // Drop lists for link/image/media/template dialogs
        template_external_list_url: "lists/template_list.js",
        external_link_list_url: "lists/link_list.js",
        external_image_list_url: "lists/image_list.js",
        media_external_list_url: "lists/media_list.js",
        file_browser_callback: "tinyBrowser",
        // Style formats
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        // Replace values for the template plugin
        template_replace_values: {
            username: "UPINSIDE TECNOLOGIA",
            staffid: "991234"
        }
    });
});


$(function () {
    function split(val) {
        return val.split(/,\s*/);
    }
    function extractLast(term) {
        return split(term).pop();
    }

    $('#txtAreaAtuacao').on("keydown", function (event) {
        if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
            event.preventDefault();
        }
    }).autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '__jsc/areaAtuacao.php',
                dataType: "json",
                data: {
                    name_startsWith: extractLast(request.term),
                    type: 'areaatuacao'
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item,
                            value: item
                        };
                    }));
                }
            });
        },
        search: function () {
            // custom minLength
            var term = extractLast(this.value);
            if (term.length < 1) {
                return false;
            }
        },
        focus: function () {
            // prevent value inserted on focus
            return false;
        },             
        select: function (event, ui) {
            var terms = split(this.value);
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push(ui.item.value);
            // add placeholder to get the comma-and-space at the end
            terms.push("");
           
            this.value = terms.join(", ");
            return false;
            
        },
    }).blur(function (){
        
    });

});

function EnviarAreaAtuacao(){
                $.ajax({
                url: '__jsc/areaAtuacao.php',
                dataType: "json",
                data: {
                    type: termos,
                },
                success: alert('dados enviados')
            });
};


function TestaCPF(strCPF) {
    strCPF = preg_replace("/[^0-9]/", "", strCPF);
    var Soma;
    var Resto;
    Soma = 0;
	if (strCPF == "00000000000") return false;
    
	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
	
	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}