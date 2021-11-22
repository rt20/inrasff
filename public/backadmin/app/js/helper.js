/* Init select2  */
function initS2FieldWithAjax(elId, route, data, attrs, callback) {
    $.ajax({
        type: 'GET',
        url: route,
        data: data
    }).then(function (res) {

        let optText = '';
        attrs.forEach((item, i) => {
            if (i != 0) {
                optText += ' - ';
            }
            optText += res[item];
        });
        let option = new Option(optText, res.id, true, true);
        $(elId).append(option).trigger('change');
        if (callback) {
            callback(res);
        }
    });
}

/**
 * Initialize select2 field without AJAX call
 * 
 * @param {String} selector 
 * @param {Object} data 
 * @param {Array} attrs 
 * @param {Function} callback 
 */
function initS2Field(selector, data, attrs, callback) {

    let optText = '';
    attrs.forEach((item, i) => {
        if (i != 0) {
            optText += ' - ';
        }
        optText += data[item];
    });

    let option = new Option(optText, data.id, true, true);
    $(selector).append(option).trigger('change');

    if (callback) {
        callback(data)
    }
}

/*
    Generate options and select null value
*/
function generateOptions(selector, placeholder, data, attrs, delimiter) {
    let field = $(selector);// console.log(selector, placeholder, data, attrs, delimiter);
    field.empty();
    field.append(new Option(placeholder, '', true, true));
    field.find('option').prop('disabled', true);

    data.forEach((element, index) => {
        let optText = '';
        attrs.forEach((item, i) => {
            if (i != 0) {
                optText += delimiter;
            }
            optText += element[item];
        });
        let option = new Option(optText, index, false, false);
        field.append(option);
    });
    field.val(null).trigger('change').prop('disabled', false);
}

/**
 * Get shipping
 */
function getShipping(selector, addresses, url, callback) {
    $(selector).off('change').on('change', function (e) {
        let address = addresses[this.value];
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                regency_id: address.id_regency
            },
            success: function (res) {
                if (res != null) {
                    if (callback) {
                        callback(res);
                    }
                }
            }
        })
    })
}

/**
 * Return formatted number
 * 
 * @param {int} val 
 * @returns 
 */
function numberFormat(val) {
    return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(val);
}

/**
 * Convert formatted string to number
 * 
 * @param {String} val 
 * @returns 
 */
function parseNumber(val) {
    let text = parseFloat(val.replace(/[^0-9$,]/g, '').replace(',', '.'));
    return (isNaN(text)) ? 0 : text;
}

/**
 * 
 * @param {String} history 
 * @param {String} status 
 * @returns 
 */
function getHistoryByStatus(history, status) {
    let obj = history.find(el => (el.status == status))
    if (obj) {
        return obj.date;
    } else {
        return '-';
    }
}

/**
 * @param {Number} number
 * @returns
 */
function stringFormatNumber(number) {
    //Triliun
    if (number >= Math.pow(10, 12)) {
        return ((number / Math.pow(10, 12)).toFixed(2)).replace(".", ",") + "T"
    }
    // Miliar
    else if (number >= Math.pow(10, 9)) {
        return ((number / Math.pow(10, 9)).toFixed(2)).replace(".", ",") + " M"
    }
    // Jt
    else if (number >= Math.pow(10, 6)) {
        return ((number / Math.pow(10, 6)).toFixed(2)).replace(".", ",") + " Jt"
    }
    // Rb
    else if (number >= Math.pow(10, 3)) {
        return ((number / Math.pow(10, 3)).toFixed(2)).replace(".", ",") + " Rb"

    } else {
        return numberFormat(number)
    }
}

/**
 * Convert date/datetime string to desired format
 */
function convertDateString(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('id', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    }).format(date);
}


function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
}

// function alpha_only(e){
function alpha_only(text) {
    var regex = /^[a-zA-Z ]+$/;
    // if (regex.test(e.value) !== true)
    //     e.value = e.value.replace(/[^a-zA-Z ]+/, '');
    if (regex.test(text) !== true)
        return text.replace(/[^a-zA-Z ]+/, '');
}
// function number_only(e) {
function number_only(text) {
    var regex = /^[0-9]+$/;
    // if (regex.test(e.value) !== true)
    //     e.value = e.value.replace(/[^0-9]+/, '');
    if (regex.test(text) !== true)
        return text.replace(/[^0-9]+/, '');
}


/**
 * Initiate S2 With option
 */
function initiateS2(
    elId,
    url,
    minimumInputLength = 3,
    placeholder = "Masukan Pilihan",
    attrs,
    onSelect,
    paramsCallback = null
) {
    return $(elId).select2({
        ajax: {
            url: url,
            data: paramsCallback ?? function (params) {
                let req = {
                    q: params.term,
                };
                return req;
            },
            processResults: function (data) {
                return { results: data };
            },
        },
        minimumInputLength: minimumInputLength,
        placeholder: placeholder,
        templateResult: function (data) {
            var text = "";
            for (let i = 0; i < attrs.length; i++) {
                text += data[attrs[i]]

                if (i != attrs.length - 1) {
                    text += " - "
                }
            }
            return data.loading ? 'Mencari...' : text
        },
        templateSelection: function (data) {
            var text = "";
            for (let i = 0; i < attrs.length; i++) {
                text += data[attrs[i]]

                if (i != attrs.length - 1) {
                    text += " - "
                }
            }
            return data.text || text;
        }

    }).on('select2:select', function (e) {
        // form.downstream.country_id = e.target.value
        if (onSelect)
            onSelect(e)
    })
}
