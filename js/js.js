/*

* Price Format jQuery Plugin
* By Eduardo Cuducos
* cuducos [at] gmail [dot] com
* Version: 1.1
* Release: 2009-02-10

* original char limit by Fl�vio Silveira <http://flaviosilveira.com>
* original keydown event attachment by Kaihua Qi
* keydown fixes by Thasmo <http://thasmo.com>

*/

(function($) {

    $.fn.priceFormat = function(options) {

        var defaults = {
            prefix: 'US$ ',
            centsSeparator: '.', 
            thousandsSeparator: ',',
            limit: false,
            centsLimit: 2
        };

        var options = $.extend(defaults, options);

        return this.each(function() {

            // pre defined options
            var obj = $(this);
            var is_number = /[0-9]/;

            // load the pluggings settings
            var prefix = options.prefix;
            var centsSeparator = options.centsSeparator;
            var thousandsSeparator = options.thousandsSeparator;
            var limit = options.limit;
            var centsLimit = options.centsLimit;

            // skip everything that isn't a number
            // and also skip the left zeroes
            function to_numbers (str) {
                var formatted = '';
                for (var i=0;i<(str.length);i++) {
                    char = str.charAt(i);
                    if (formatted.length==0 && char==0) char = false;
                    if (char && char.match(is_number)) {
                        if (limit) {
                            if (formatted.length < limit) formatted = formatted+char;
                        }else{
                            formatted = formatted+char;
                        }
                    }
                }
                return formatted;
            }

            // format to fill with zeros to complete cents chars
            function fill_with_zeroes (str) {
                while (str.length<(centsLimit+1)) str = '0'+str;
                return str;
            }

            // format as price
            function price_format (str) {

                // formatting settings
                var formatted = fill_with_zeroes(to_numbers(str));
                var thousandsFormatted = '';
                var thousandsCount = 0;

                // split integer from cents
                var centsVal = formatted.substr(formatted.length-centsLimit,centsLimit);
                var integerVal = formatted.substr(0,formatted.length-centsLimit);

                // apply cents pontuation
                formatted = integerVal+centsSeparator+centsVal;

                // apply thousands pontuation
                if (thousandsSeparator) {
                    for (var j=integerVal.length;j>0;j--) {
                        char = integerVal.substr(j-1,1);
                        thousandsCount++;
                        if (thousandsCount%3==0) char = thousandsSeparator+char;
                        thousandsFormatted = char+thousandsFormatted;
                    }
                    if (thousandsFormatted.substr(0,1)==thousandsSeparator) thousandsFormatted = thousandsFormatted.substring(1,thousandsFormatted.length);
                    formatted = thousandsFormatted+centsSeparator+centsVal;
                }

                // apply the prefix
                if (prefix) formatted = prefix+formatted;

                return formatted;

            }

            // filter what user type (only numbers and functional keys)
            function key_check (e) {
		
                var code = (e.keyCode ? e.keyCode : e.which);
                var typed = String.fromCharCode(code);
                var functional = false;
                var str = obj.val();
                var newValue = price_format(str+typed);
				
                // allow keypad numbers, 0 to 9
                if(code >= 96 && code <= 105) functional = true;

                // check Backspace, Tab, Enter, and left/right arrows
                if (code ==  8) functional = true;
                if (code ==  9) functional = true;
                if (code == 13) functional = true;
                if (code == 37) functional = true;
                if (code == 39) functional = true;

                if (!functional) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (str!=newValue) obj.val(newValue);
                }

            }

            // inster formatted price as a value of an input field
            function price_it () {
                var str = obj.val();
                var price = price_format(str);
                if (str != price) obj.val(price);
            }

            // bind the actions
            $(this).bind('keydown', key_check);
            $(this).bind('keyup', price_it);
            if ($(this).val().length>0) price_it();
	
        });
	
    }; 		
	
})(jQuery);
/*
Rotinas
*/
function SubmitForm(Form)
{
	
    $("#" + Form).submit();
	
}
function LimpaForm(Form)
{
	
    $("#" + Form).reset();
	
}


var Validacao = {
	
    NumeroInteiro: function(Numero)
    {
		
        if(isNaN(parseInt(Numero)))
        {
			
            return false;
			
        }else{
			
            return true;
			
        }
		
    },
	
    CPF: function(Dado)
    {
		
        var i; 
        s = Dado; 
        s = s.replace(".", "");
        s = s.replace(".", "");
        s = s.replace("-", "");
		
        if(s=="11111111111" || s=="22222222222" || s=="33333333333" || s=="44444444444" || s=="55555555555" || s=="66666666666" || s=="77777777777" || s=="88888888888" || s=="99999999999")
        {
            return false; 
        }
			
		
        var c = s.substr(0,9); 
        var dv = s.substr(9,2); 
        var d1 = 0; 
		
        for (i = 0; i < 9; i++) 
        { 
            d1 += c.charAt(i)*(10-i); 
        } 
		
        if (d1 == 0)
        { 
            return false; 
        } 
		
        d1 = 11 - (d1 % 11); 
        if (d1 > 9) d1 = 0; 
        if (dv.charAt(0) != d1) 
        { 
            return false; 
        } 
        d1 *= 2; 
        for (i = 0; i < 9; i++) 
        { 
            d1 += c.charAt(i)*(11-i); 
        } 
        d1 = 11 - (d1 % 11); 
        if (d1 > 9) d1 = 0; 
        if (dv.charAt(1) != d1) 
        { 
            return false; 
        } 
		
        return true;
		
    },
	
    Data: function(pObj)
    {
		
        var expReg = /^(([0-2]\d|[3][0-1])\/([0]\d|[1][0-2])\/[1-2][0-9]\d{2})$/;

        if ((pObj.match(expReg)) && (pObj!=''))
        {
			
            var dia = pObj.substring(0,2);
            var mes = pObj.substring(3,5);
            var ano = pObj.substring(6,10);
			
            if((mes==4 || mes==6 || mes==9 || mes==11) && dia > 30){
                //alert("Dia incorreto !!! O m�s especificado cont�m no m�ximo 30 dias.");
                return false;
            } else{
                if(ano%4!=0 && mes==2 && dia>28){
                    //alert("Data incorreta!! O m�s especificado cont�m no m�ximo 28 dias.");
                    return false;
                } else{
                    if(ano%4==0 && mes==2 && dia>29){
                        //alert("Data incorreta!! O m�s especificado cont�m no m�ximo 29 dias.");
                        return false;
                    } else{
                        //alert ("Data correta!");
                        return true;
                    }
                }
            }
			
        } else {

            return false;
		
        }
	 
    }
	
};
function RetroClock(CodigoLeilao, Tempo, Tipo)
{
    /*
	L_Tempo_A[CodigoLeilao]
	L_Tempo_B[CodigoLeilao]
	*/
    switch(Tipo)
    {
		
        case "S":
		
            if(parseInt(Tempo)==0)
            {
				
                $("#L_Tempo_" + CodigoLeilao).html("<span style='color:red'>00:00:00</span>");
				
            }else{
				
                if(parseInt(Tempo)<10)
                {
					
                    $("#L_Tempo_" + CodigoLeilao).html("<span style='color:red'>00:00:0" + Tempo + "</span>")
					
                }else{
					
                    $("#L_Tempo_" + CodigoLeilao).html("00:00:" + Tempo)
					
                }
			
            }
	
            break;
		
        case "U":
		
            day 		= Math.floor(Tempo / 86400);
            hours 		= Math.floor((Tempo - ( day * 86400 )) / 3600);
            minutes 	= Math.floor((Tempo - ( day * 86400 ) - ( hours * 3600 )) / 60);
            seconds 	= Math.round(Tempo - ( day * 86400 ) - ( hours * 3600 ) - ( minutes * 60 ));
			
            hours 		= ("00" + hours).substring(("00" + hours).length-2);
            minutes 	= ("00" + minutes).substring(("00" + minutes).length-2);
            seconds 	= ("00" + seconds).substring(("00" + seconds).length-2);
		
            if(parseInt(Tempo)==0)
            {
				
                $("#L_Tempo_" + CodigoLeilao).html("<span class='TempoVermelho'>" + day + "d:" + hours + "h:" + minutes + "m:" + seconds + "s</span>");
				
            }else{
				
                if(parseInt(Tempo)<10)
                {
					
                    $("#L_Tempo_" + CodigoLeilao).html("<span class='TempoVermelho'>" + day + "d:" + hours + "h:" + minutes + "m:" + seconds + "s</span>");
					
                }else{
					
                    $("#L_Tempo_" + CodigoLeilao).html(day + "d:" + hours + "h:" + minutes + "m:" + seconds + "s");
					
                }
			
            }
		
            break;
		
    }
	
}

function date ( format, timestamp ) {
    // http://kevin.vanzonneveld.net
    // +   original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
    // +      parts by: Peter-Paul Koch (http://www.quirksmode.org/js/beat.html)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: MeEtc (http://yass.meetcweb.com)
    // +   improved by: Brad Touesnard
    // +   improved by: Tim Wiel
    // +   improved by: Bryan Elliott
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: David Randall
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +  derived from: gettimeofday
    // +      input by: majak
    // +   bugfixed by: majak
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Alex
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // %        note 1: Uses global: php_js to store the default timezone
    // *     example 1: date('H:m:s \\m \\i\\s \\m\\o\\n\\t\\h', 1062402400);
    // *     returns 1: '09:09:40 m is month'
    // *     example 2: date('F j, Y, g:i a', 1062462400);
    // *     returns 2: 'September 2, 2003, 2:26 am'
    // *     example 3: date('Y W o', 1062462400);
    // *     returns 3: '2003 36 2003'
    // *     example 4: x = date('Y m d', (new Date()).getTime()/1000); // 2009 01 09
    // *     example 4: (x+'').length == 10
    // *     returns 4: true
    // *     example 5: date('W', 1104534000);
    // *     returns 5: '53'
    // *     example 6: date('B t', 1104534000);
    // *     returns 6: '999 31'
    // *     example 7: date('W', 1293750000); // 2010-12-31
    // *     returns 7: '52'
    // *     example 8: date('W', 1293836400); // 2011-01-01
    // *     returns 8: '52'
    // *     example 9: date('W Y-m-d', 1293974054); // 2011-01-02
    // *     returns 9: '52 2011-01-02'

    var that = this,
    jsdate = (
        (typeof timestamp === 'undefined') ? new Date() : // Not provided
        (timestamp instanceof Date) ? new Date(timestamp) : // Javascript Date()
        new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
        ), //, tal= [], // Keep this here (works, but for code commented-out below for file size reasons)
    formatChr = /\\?([a-z])/gi,
    formatChrCb = function (t, s) {
        return f[t] ? f[t]() : s;
    },
    _pad = function (n, c) {
        if ((n = n + "").length < c) {
            return new Array((++c) - n.length).join("0") + n;
        } else {
            return n;
        }
    },
    txt_words = ["Domingo", "Segunda-Feira", "Ter&ccedil;a-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "S&aacute;bado",
    "Janeiro", "Fevereiro", "Mar&ccedil;o", "Abril", "Maio", "Junho", "Julho",
    "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
    txt_ordin = {
        1: "st", 
        2: "nd", 
        3: "rd", 
        21: "st", 
        22: "nd", 
        23: "rd", 
        31: "st"
    },
    f = {
        // Day
        d: function () {
            return _pad(f.j(), 2);
        },
        D: function () {
            return f.l().slice(0, 3);
        },
        j: function () {
            return jsdate.getDate();
        },
        l: function () {
            return txt_words[f.w()];
        },
        N: function () {
            return f.w() || 7;
        },
        S: function () {
            return txt_ordin[f.j()] || 'th';
        },
        w: function () {
            return jsdate.getDay();
        },
        z: function () {
            return (jsdate - new Date(f.Y(), 0, 1)) / 864e5 >> 0;

        },

        // Week
        W: function () {
            var c = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3);
            return 1 + Math.round((c - (new Date(c.getFullYear(), 0, 4))) / 864e5 / 7);
        },

        // Month
        F: function () {
            return txt_words[6 + f.n()];
        },
        m: function () {
            return _pad(f.n(), 2);
        },
        M: function () {
            return f.F().slice(0, 3);
        },
        n: function () {
            return jsdate.getMonth() + 1;
        },
        t: function () {
            return (new Date(f.Y(), f.n() + 1, 0)).getDate();
        },

        // Year
        L: function () {
            var y = f.Y();
            return (!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0;
        },
        o: function () {
            return f.Y() + (f.n() === 12 && f.W() < 9 ? -1 : (f.n() === 1 && f.W() > 9 ? 1 : 0));
        },
        Y: function () {
            return jsdate.getFullYear();
        },
        y: function () {
            return (jsdate.getFullYear() + "").slice(2);
        },

        // Time
        a: function () {
            return jsdate.getHours() > 11 ? "pm" : "am";
        },
        A: function () {
            return f.a().toUpperCase();
        },
        B: function () {
            return _pad(Math.floor(((jsdate.getUTCHours() * 36e2) + (jsdate.getUTCMinutes() * 60) +
                jsdate.getUTCSeconds() + 36e2) / 86.4) % 1e3, 3);
        },
        g: function () {
            return jsdate.getHours() % 12 || 12;
        },
        G: function () {
            return jsdate.getHours();
        },
        h: function () {
            return _pad(f.g(), 2);
        },
        H: function () {
            return _pad(f.G(), 2);
        },
        i: function () {
            return _pad(jsdate.getMinutes(), 2);
        },
        s: function () {
            return _pad(jsdate.getSeconds(), 2);
        },
        u: function () {
            return _pad(jsdate.getMilliseconds() * 1000, 6);
        },

        // Timezone
        e: function () {
            
            return 'UTC';
        },
        I: function () {
            // Compares Jan 1 minus Jan 1 UTC to Jul 1 minus Jul 1 UTC.
            // If they are not equal, then DST is observed.
            return 0 + (((new Date(f.Y(), 0)) - Date.UTC(f.Y(), 0)) !== ((new Date(f.Y(), 6)) - Date.UTC(f.Y(), 6)));
        },
        O: function () {
            var a = jsdate.getTimezoneOffset();
            return (a > 0 ? "-" : "+") + _pad(Math.abs(a / 60 * 100), 4);
        },
        P: function () {
            var O = f.O();
            return (O.substr(0, 3) + ":" + O.substr(3, 2));
        },
        T: function () {

            return 'UTC';
        },
        Z: function () {
            return -jsdate.getTimezoneOffset() * 60;
        },

        // Full Date/Time
        c: function () {
            return 'Y-m-d\\Th:i:sP'.replace(formatChr, formatChrCb);
        },
        r: function () {
            return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb);
        },
        U: function () {
            return Math.round(jsdate.getTime() / 1000);
        }
    };
    return format.replace(formatChr, formatChrCb);
}

function mktime() 
{
	
    var no=0, i = 0, ma=0, mb=0, d = new Date(), dn = new Date(), argv = arguments, argc = argv.length;
    //alert(dn);
    var dateManip = {
        0: function (tt){
            return d.setHours(tt);
        },
        1: function (tt){
            return d.setMinutes(tt);
        },
        2: function (tt){
            var set = d.setSeconds(tt);
            mb = d.getDate() - dn.getDate();
            d.setDate(1);
            return set;
        },
        3: function (tt){
            var set = d.setMonth(parseInt(tt, 10)-1);
            ma = d.getFullYear() - dn.getFullYear();
            return set;
        },
        4: function (tt){
            return d.setDate(tt+mb);
        },
        5: function (tt){
            if (tt >= 0 && tt <= 69) {
                tt += 2000;
            }
            else if (tt >= 70 && tt <= 100) {
                tt += 1900;
            }
            return d.setFullYear(tt+ma);
        }
    // 7th argument (for DST) is deprecated
    };

    for (i = 0; i < argc; i++){
        no = parseInt(argv[i]*1, 10);
        if (isNaN(no)) {
            return false;
        } else {
            // arg is number, let's manipulate date object
            if (!dateManip[i](no)){
                // failed
                return false;
            }
        }
    }
    for (i = argc; i < 6; i++) {
        switch (i) {
            case 0:
                no = dn.getHours();
                break;
            case 1:
                no = dn.getMinutes();
                break;
            case 2:
                no = dn.getSeconds();
                break;
            case 3:
                no = dn.getMonth()+1;
                break;
            case 4:
                no = dn.getDate();
                break;
            case 5:
                no = dn.getFullYear();
                break;
        }
        dateManip[i](no);
    }

    return Math.floor(d.getTime()/1000);
	
}
function number_format (number, decimals, dec_point, thousands_sep) {
   
    var n = number, prec = decimals;

    var toFixedFix = function (n,prec) {
        var k = Math.pow(10,prec);
        return (Math.round(n*k)/k).toString();
    };

    n = !isFinite(+n) ? 0 : +n;
    prec = !isFinite(+prec) ? 0 : Math.abs(prec);
    var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
    var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

    var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

    var abs = toFixedFix(Math.abs(n), prec);
    var _, i;

    if (abs >= 1000) {
        _ = abs.split(/\D/);
        i = _[0].length % 3 || 3;

        _[0] = s.slice(0,i + (n < 0)) +
        _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
        s = _.join(dec);
    } else {
        s = s.replace('.', dec);
    }

    var decPos = s.indexOf(dec);
    if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
        s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
    }
    else if (prec >= 1 && decPos === -1) {
        s += dec+new Array(prec).join(0)+'0';
    }
    return s;
}
function TempoCliente()
{
	
    var thisDate = new Date();
	
    return thisDate.getDate() + "/" + (thisDate.getMonth()+1) + "/" + thisDate.getFullYear() + "/" + thisDate.getHours() + "/" + thisDate.getMinutes() + "/" + thisDate.getSeconds();
	
}
//##############
var Requisitacoes_RelogioTopo;
var Requisitacoes_ContDow;
var Requisitacoes_Leiloes;
var Requisitacoes_FalhaTempo;

var ListaLeiloesOnline 		= "";
var TotalLeiloesOnline 		= 0;

var GmtSegundo 				= 0;
var FalhaTempo				= 0;

function CalculaGMT()
{
	
    DataTmp 		= new Date();
    GtmCliente 		= DataTmp.getTimezoneOffset()/60;
	
    GmtServidor 	= 3; //GMT -3 Horas
    GmtDiferenca	= GmtServidor - GtmCliente;
	
    GmtSegundo		= GmtDiferenca * 60 * 60;
	
}

function ProcuraFalhaTempo()
{
	
    TempoA = mktime();
        
        
    $.post("/otimolance/clance/retHorario", {},
        function(data){
            //alert(data.time);
            msg = data.time;
            TempoB 		= mktime();
            TempoAB		= TempoB - TempoA;
			
            FalhaTempo 	= parseInt(msg) - parseInt(TempoB);
			
            var req = null
            delete req
			
            window.setTimeout("ProcuraFalhaTempo()", 60000);

        }, "json");
    
    var req = null
    delete req
}

function MontaListaLeiloes()
{
	
    $(".LeilaoOnline").each( 
        function() 
        { 
	
            ListaLeiloesOnline = ListaLeiloesOnline + "_" + $(this).val();
            TotalLeiloesOnline = TotalLeiloesOnline + 1;
		
        });
	
}

function MontaHistoricoLeilao(CodigoLeilao, ListaHistorico)
{
	
    TipoLeilao	= $("#TipoLeilao_" + CodigoLeilao).val();
	
    switch(TipoLeilao)
    {
		
        case "S":
		
            ListaHistorico = ListaHistorico.split("####");
			
            TextoH = 	'';
            TextoH = 	'<table width="100%" cellpadding="2" cellspacing="0">'+
            '<tr>'+
            '<td colspan="2" align="center" bgcolor="#36322f" height="25" class="h2" style="font-weight:bold;">Hist�rico de Lances</td>'+
            '</tr>'+
            '<tr>'+
            '<td align="center" class="h1" style="font-weight:bold;">Lance</td>'+
            '<td align="center" class="h1" style="font-weight:bold;">Usu�rio</td>'+
            '</tr>';
						
            if(ListaHistorico.length>0)
            {
				
                for (ix=0; ix<=ListaHistorico.length-2;ix++)
                {
					
                    if(ix<=12)
                    {
						
                        LanceValorSepara = ListaHistorico[ix].split("##");
                        TextoH = TextoH +	'<tr>'+
                        '<td align="center" class="h5">R$ '+number_format(LanceValorSepara[0], 2, ',', '.')+'</td>'+
                        '<td align="center" class="h5">'+LanceValorSepara[1]+'</td>'+
                        '</tr>';
									
                    }
					
                }
				
            }
			
            TextoH = TextoH +	'</table>';
		
            $("#L_LancesHistorico_" + CodigoLeilao).html(TextoH);	
		
            break;
		
        case "U":
		
            ListaHistorico = ListaHistorico.split("####");
			
            TextoH = 	'';
            TextoH = 	'<table width="100%" cellpadding="2" cellspacing="0">'+
            '<tr>'+
            '<td colspan="2" align="center" bgcolor="#36322f" height="25" class="h2" style="font-weight:bold;">Hist�rico de Lances</td>'+
            '</tr>'+
            '<tr>'+
            '<td align="center" class="h1" style="font-weight:bold;">Usu�rio</td>'+
            '<td align="center" class="h1" style="font-weight:bold;">Data</td>'+
            '</tr>';
						
            if(ListaHistorico.length>0)
            {
				
                for (ix=0; ix<=ListaHistorico.length-2;ix++)
                {
					
                    if(ix<=12)
                    {
						
                        LanceValorSepara = ListaHistorico[ix].split("##");
                        TextoH = TextoH +	'<tr>'+
                        '<td align="center" class="h5">'+LanceValorSepara[2]+'</td>'+
                        '<td align="center" class="h5" style="font-size:10px;">'+LanceValorSepara[0]+' '+LanceValorSepara[1]+'</td>'+
                        '</tr>';
									
                    }
					
                }
				
            }
			
            TextoH = TextoH +	'</table>';
		
            $("#L_LancesHistorico_" + CodigoLeilao).html(TextoH);
		
            break;
		
    }
	
	
}

var TempoUltimaReq		= 0;
var QtdReqLeiloes		= 0;

function RequisitacaoLeiloes()
{
	
    if(TotalLeiloesOnline>0)
    {
		
        clearTimeout(Requisitacoes_Leiloes);
		
        try
        {
				
                       
            var req =  $.post("/otimolance/clance/getDadosLeilao", {
                "Leiloes":ListaLeiloesOnline
            },
            function(msg){
                QtdReqLeiloes = QtdReqLeiloes + 1;
					
                if(msg.length >= 1)
                {
						
                    Valores = eval(msg);
						
                    for (i=0; i<TotalLeiloesOnline;i++)
                    {
							
                        Ret		= Valores[i]; 
                        Cod 	= Ret.idLeilao;
							
                        //                       $("#L_LanceAtual"+Cod).html(Ret.UltimoValor);
                        $("#L_Fixador_"+Cod).html(Ret.tempoCronometro);
                        //                   $("#L_FaltaSegundos_"+Cod).html(Ret.FaltaSegundos);
                        $("#L_UltimoLogin_"+Cod).html(Ret.login);
                        //               $("#L_UltimoCodigo_"+Cod).html(Ret.UltimoCodigo);
                        $("#L_UltimoValor_"+Cod).html(roundNumber(Ret.valor,3));
                        //           $("#L_Status_"+Cod).html(Ret.Status);
                        $("#L_MicroTimeFim_"+Cod).html(Ret.MicroTimeFim);
                        //           $("#L_QtdLances_"+Cod).html(Ret.QtdLances);					
                        //           $("#L_EconomiaV_"+Cod).html(Ret.EconomiaV);
                        //           $("#L_EconomiaP_"+Cod).html(Ret.EconomiaP);
                        //           $("#L_DescontoLances_"+Cod).html(Ret.DescontoLances);
                        //           $("#L_CompraValor_"+Cod).html(Ret.CompraValor);
							
                        //                 $("#L_ValoMercado_A"+Cod).html(Ret.ValorMercado);
                        //               $("#L_ValoMercado_B"+Cod).html(Ret.ValorMercado);
                        //             $("#L_ValoMercado_C"+Cod).html(Ret.ValorMercado);
							
                        $("#L_DataInicio_"+Cod).html(Ret.dataInicio);
							
                        $("#leilaoinfo_"+Cod).val(Ret.MicroTimeFim+"__"+Ret.tempoCronometro+"__"+Ret.status);
                        var req = null
                        delete req
					
                        if(QtdReqLeiloes==1)
                        {
						
                            ContDowLeiloes();
			
                        }
					
                        Requisitacoes_Leiloes = window.setTimeout("RequisitacaoLeiloes()", 500);

                    }
                    }
                }, "json");           
			
           
        var req = null
        delete req

    }catch(err){

        Requisitacoes_Leiloes = window.setTimeout("RequisitacaoLeiloes()", 500);

    }	
	
}
	
}

function ContDowLeiloes()
{
	
    if(TotalLeiloesOnline>0)
    {
		
        clearTimeout(Requisitacoes_ContDow);
		
        SeparaLeiloes 		= ListaLeiloesOnline.split("_");
		
        for(i=1;i<=TotalLeiloesOnline;i++)
        {
			
            //###############################
            CodigoLeilao	= SeparaLeiloes[i];
            VarBox 			= $("#leilaoinfo_" + CodigoLeilao).val();
	
            VarBoxSepara 	= VarBox.split("__");
			
            //MkTime Atual
            TimeAtual		= mktime();

            //MkTime do Produto
            TimeProduto		= Trim(VarBoxSepara[0]);
            //Fixador d Tempo
            Fixador			= Trim(VarBoxSepara[1]);
            //Tempo
            Status			= Trim(VarBoxSepara[2]);
			
            //Calcula os segundos restantes para acabar o leil�o
            Diferenca		= TimeProduto - TimeAtual /*- GmtSegundo*/ - FalhaTempo  - 1;
		//alert(Diferenca);	
			
            if(Status=="2")
            {
				
                CarregaTimeLeilao(CodigoLeilao, Fixador, Diferenca);
				
            }else if(Status=="3"){
				
                CarregaTimeLeilao(CodigoLeilao, Fixador, Fixador);
			
            }else if(Status=="F"){
				
                DisparaFinalizadoLeilao(CodigoLeilao);
				
            }
        //###############################
			
        }
		
        Requisitacoes_ContDow = window.setTimeout("ContDowLeiloes()", 500);
	
    }
	
}

function DisparaFinalizadoLeilao(CodigoLeilao)
{

    TipoLeilao	= $("#TipoLeilao_" + CodigoLeilao).val();
	
    $("#boxBtn_"+CodigoLeilao).html("<span class='h3'>Arrematado</span>");
    $("#L_Tempo_" + CodigoLeilao).html("00:00:00");
    //$("#BoxDeletBtn_" + CodigoLeilao).html("");
	
    RetroClock(CodigoLeilao, 0, TipoLeilao);
    //LayerFechar(CodigoLeilao);
	
	
}

function CarregaTimeLeilao(CodigoLeilao, Fixador, Diferenca)
{
	
    TipoLeilao	= $("#leilaotipo_" + CodigoLeilao).val();
	
    switch(TipoLeilao)
    {
	
        case "S":
		
            if(Diferenca<1)
            {
				
                RetroClock(CodigoLeilao, 1, TipoLeilao);
                $("#LeilaoOnline_UltimoTempo_" + CodigoLeilao).html(1)
				
            }else{
		
                if(Diferenca<Fixador)
                {
					
                    RetroClock(CodigoLeilao, Diferenca, TipoLeilao);
                    $("#LeilaoOnline_UltimoTempo_" + CodigoLeilao).html(Diferenca)
					
                }else{
					
                    RetroClock(CodigoLeilao, Fixador, TipoLeilao);
                    $("#LeilaoOnline_UltimoTempo_" + CodigoLeilao).html(Fixador)
					
                }
                
			
            }
		
            break;
		
        case "U":
			
            if( Diferenca <= 0 ) 
            {
				
                LayerFechar(CodigoLeilao);
                $("#L_Tempo_" + CodigoLeilao).html("<span class='TempoVermelho'>Finalizando...</span>");
				
            }else{
				
                RetroClock(CodigoLeilao, Diferenca, TipoLeilao);
				
            }
			
            break;	
		
    }
	
	

}

function LayerFechar(CodigoLeilao)
{
	
    $("#Layer_Erro_" + CodigoLeilao).hide();
    $("#Layer_Erro_Msg_" + CodigoLeilao).html("");
	
    $("#Layer_Ok_" + CodigoLeilao).hide();
    $("#Layer_Ok_Msg_" + CodigoLeilao).html("");
	
}
function LayerErro(CodigoLeilao, Mensagem)
{
	
    $("#Layer_Erro_" + CodigoLeilao).show();
    $("#Layer_Erro_Msg_" + CodigoLeilao).html(Mensagem);
	
    $("#Layer_Ok_" + CodigoLeilao).hide();
    $("#Layer_Ok_Msg_" + CodigoLeilao).html("");
	
}
function LayerSucesso(CodigoLeilao, Mensagem)
{
	
    $("#Layer_Erro_" + CodigoLeilao).hide();
    $("#Layer_Erro_Msg_" + CodigoLeilao).html("");
	
    $("#Layer_Ok_" + CodigoLeilao).show();
    $("#Layer_Ok_Msg_" + CodigoLeilao).html(Mensagem);
	
}
function ExecutarLance(CodigoLeilao)
{
	
    $("#L_BotaoA_" + CodigoLeilao).hide();
    $("#L_BotaoB_" + CodigoLeilao).show();
	
    ValorLanceC				= $("#ValorLanceInformado_" + CodigoLeilao).val();
    MultilanceC				= $("#MultiLanceInformado_" + CodigoLeilao + " option:selected").val();
	
    var req = $.ajax({
			
        type: 		"GET",
        url: 		"Req_ExecutaLance.php",
        cache: 		false,
        timeout: 	60000,
        data: 		"CodigoLeilao=" + CodigoLeilao + "&ValorLance=" + ValorLanceC + "&Rand=" + encodeURI(Math.random()) + "&Multilance=" + MultilanceC,
        success: 	function(msg)
        {
			
            $("#ValorLanceInformado_" + CodigoLeilao).val("0")
            $("#MultiLanceInformado_" + CodigoLeilao).val("0");
			
            Tmpa = msg.split("##");
			
            switch(Tmpa[0])
            {
				
                case "NAOLOCALIZADO":
				
                    DisparaFinalizadoLeilao(CodigoLeilao);
                    alert("Leil�o j� Finalizado!");
					
                    break;
				
                case "LO_SE":
				
                    alert("J� existe um lance seu sendo executado!");
				
                    break;
				
                case "MESMOIP":
					
                    alert("Apenas � permitido um Usu�rio Por IP em um mesmo leil�o!");
					
                    break;
				
                case "TIPO_COMPRADOR":
					
                    alert("Este leil�o � apenas para clientes que ja compraram algum pacote de lances!");
					
                    break;
				
                case "TIPO_BONUS":
					
                    alert("Este leil�o � apenas para quem ainda n�o comprou nenhum pacote de lances!");
					
                    break;
				
                case "SEMLANCES":
					
                    if(confirm("Recarregue seus lances!"))
                    {
						
                        window.location = "MinhaConta_ComprarLances.php";
					
                    }
				
                    break;
				
                case "NAOLOGADO":
				
                    if(confirm("Efetue seu Login!"))
                    {
						
                        window.location = "Login.php";
					
                    }
				
                    break;
				
                case "PAUSADO":
				
                    alert("Este leil�o esta Pausado!");
					
                    break;
				
				
				
                case "LANCEREPETIDO":
				
                    //alert("O �ltimo lance j� � seu!");
				
                    break;
				
                case "LANCESENDOCOMPUTADO":
				
                    //alert("J� existe um lance seu sendo computado!");
				
                    break;
				
                case "SUCESSO":
				
                    //
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
					
                    break;
				
                case "SEMLIMITE":
				
                    alert("Seu Limite mensal foi alcan�ado!");
					
                    break;
				
                case "QtdLancesMaximosExedida":
				
                    alert("O Limite de lances, por usu�rio, neste leil�o foi alcan�ado!");					
					
                    break;
				
                case "LANCE_MAIORQUEZERO":
					
                    LayerErro(CodigoLeilao, "Voc� n�o preencheu o seu lance.");
				
                    break;
				
                case "LANCE_NUMERICO":
					
                    LayerErro(CodigoLeilao, "Seu lance deve ser n�merico.");
					
                    break;
				
                case "MULTI_N_ENCONTRADO":
				
                    LayerErro(CodigoLeilao, "Problema com encontrar o kit de lances");
				
                    break;
				
                case "VALORLANCE_JA_EFETIVADO":
					
                    LayerErro(CodigoLeilao, "Voc� j� deu o lance de (" + Tmpa[2] + ") para esse leil�o, tente novamente com outro valor.");
					
                    break;
				
				
				
				
                case "M_SUCESSO_FALHA1":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>�nico, por�m n�o o menor!</strong></span><br>Seu lance " + Tmpa[3] + " foi registrado com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
                case "M_SUCESSO_FALHA2":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Lance menor mas n�o �nico!</strong></span><br>Seu lance " + Tmpa[3] + " foi registrado com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
                case "M_SUCESSO_FALHA3":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Nem menor nem �nico!</strong></span><br>Seu lance " + Tmpa[3] + " foi registrado com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
                case "M_SUCESSO_FALHA4":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Maior, por�m n�o �nico!</strong></span><br>Seu lance " + Tmpa[3] + " foi registrado com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break
				
                case "M_SUCESSO_FALHA5":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Maior e �nico!</strong></span><br>Seu lance " + Tmpa[3] + " foi registrado com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break
				
                case "M_SUCESSO_FALHA6":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Menor e �nico!</strong></span><br>Seu lance " + Tmpa[3] + " foi registrado com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break
				
                case "M_SUCESSO_OK":
					
                    LayerSucesso(CodigoLeilao, "Parab�ns, o menor lance �nico por enquanto � o seu. Arrisque mais, aumente suas chances de ganhar, escolha outros valores.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
                case "M_SUCESSO_FALHA1M":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>�nico, por�m n�o o menor!</strong></span><br>Seus lances foram registrados com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
                case "M_SUCESSO_FALHA2M":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Lance menor mas n�o �nico!</strong></span><br>Seus lances foram registrados com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
                case "M_SUCESSO_FALHA3M":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Nem menor nem �bico!</strong></span><br>Seus lances foram registrados com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
                case "M_SUCESSO_FALHA4M":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Maior, por�m n�o �nico!</strong></span><br>Seus lances foram registrados com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break
				
                case "M_SUCESSO_FALHA5M":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Maior e �nico!</strong></span><br>Seus lances foram registrados com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break
				
                case "M_SUCESSO_FALHA6M":
					
                    LayerErro(CodigoLeilao, "<span style='color:#FFFF00'><strong>Menor e �nico!</strong></span><br>Seus lances foram registrados com sucesso.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break
				
                case "M_SUCESSO_OKM":
					
                    LayerSucesso(CodigoLeilao, "Parab�ns, o menor lance �nico por enquanto � o seu. Arrisque mais, aumente suas chances de ganhar, escolha outros valores.");
                    $("#QtdLancesUtilizadosX").html(Tmpa[2]);
                    $("#QtdLancesUtilizadosY").html(Tmpa[4]);
					
                    break;
				
				
                case "LEILAO_SENDO_FINALIZADO":
					
                    alert("Este leil�o j� esta sendo finalizado!");
					
                    break
				
            }
			
            $("#Topo_Lances").html(Tmpa[1]);
			
            $("#L_BotaoA_" + CodigoLeilao).show();
            $("#L_BotaoB_" + CodigoLeilao).hide();
			
            var req = null
            delete req
	
        },
        error: function( objRequest ){
					
            $("#L_BotaoA_" + CodigoLeilao).show();
            $("#L_BotaoB_" + CodigoLeilao).hide();
			
            var req = null
            delete req
		 
        },
        beforeSend: function()

        {
			
            var req = null
            delete req
	
        }
			
    });

    var req = null
    delete req
	
}

function LanceMulti_Detalhar( Codigo )
{
	
    $.colorbox(	{ 
        href: 			"Ajax.php?Acao=LanceMulti_Detalhar&Codigo=" + Codigo, 
        width: 			"500px", 
        height: 		"450px",
        onComplete: 	function() {
						
            LanceMulti_Detalhar_P( Codigo, "0" );
												
        }
    });
	
}
function LanceMulti_Detalhar_P( Codigo, Pagina )
{
	
    $("#BoxHAjax").html("Carregando listagem...");
	
    var req = $.ajax({
			
        type: 		"GET",
        url: 		"Ajax.php",
        timeout: 	10000,
        data: 		"Acao=LanceMulti_DetalharP&Codigo=" + Codigo + "&Pagina=" + Pagina + "&Rand=" + encodeURI(Math.random()),
        cache: 		false,
        success: 	function(msg)
        {
			
            $("#BoxHAjax").html(msg);
						
            var req = null
            delete req
	
        },
        beforeSend: function()

        {
			
            var req = null
            delete req
			
        }
			
    });
	
    var req = null
    delete req
	
}

var MicroTime = 0;
function MicroTimeServidor()
{
	
        
   var req =  $.post("/otimolance/clance/retHorario", {},
     function(msg){
               
			
            DataTmp 		= new Date();
            GtmCliente 		= DataTmp.getTimezoneOffset()/60;
			
            GmtServidor 	= 3; //GMT -3 Horas
            GmtDiferenca	= GmtServidor - GtmCliente;
			
            GmtSegundo		= GmtDiferenca * 60 * 60;
			
            MicroTime 		= msg.time - GmtSegundo;
			
            RelogioTopo();
			
            var req = null
            delete req
	
        },"json");
	
    var req = null
    delete req
	
}
function RelogioTopo()
{
	
    clearTimeout(Requisitacoes_RelogioTopo);
	
    if(MicroTime>0)
    {
			
        MicroTime 						= parseInt(MicroTime) + 1;
        Data							= date('d/m/Y | H:i:s', MicroTime);
		
        $("#relogioTopo").html(Data);
		
        Requisitacoes_RelogioTopo	= window.setTimeout("RelogioTopo()", 1000);
		
    }
	
}
$(document).ready(function() {
   
    //Seguran�a
    CalculaGMT(); //Diferen�a de tempo do GMT
    ProcuraFalhaTempo(); //Lag da conex�o
	
    //Obtem MicroTime do Servidor
    MicroTimeServidor();
 
    //Obtem leil�es da janela
    MontaListaLeiloes();
	
    //Inicia Processos
    RequisitacaoLeiloes();
	
//$('.ApenasMoeda').priceFormat({
//	prefix: 'R$ ',
//	centsSeparator: ',',
//	thousandsSeparator: '.'
//}); 
	
});