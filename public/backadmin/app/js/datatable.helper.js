/**
 * Generate columns option
 * 
 * @param {String} dataType 
 * @param {String} measure 
 * @param {Array} dataHeaders 
 * @returns 
 */
function dtColumns(dataType, measure, dataHeaders) {
    let columns = [];
    columns.push({ data: dataType });

    for (let i = 0; i < dataHeaders.length; i++) {
        columns.push({
            data: 'data.' + dataHeaders[i] + '.' + measure,
            className: 'text-right',
            searchable: false,
            render: function(data, type, row, meta) {
                if (type == 'display') {
                    let currency = (measure == 'total_ad_size') ? '' : '<span class="float-left">Rp</span>';
                    let cellContent = '<div>' + currency + stringFormatNumber(data ?? 0) + '</div>';
                    cellContent += '<div class="font-small-2">' + rowDiffPercent(row, i, dataHeaders, measure) + '<div>';
                    return cellContent;
                }

                return data;
            }
        });
    }

    columns.push({
        className: 'text-right',
        render: function(data, type, row, meta) {
            let total = 0;
            dataHeaders.forEach(header => {
                total += row.data[header][measure];
            });

            if (type == 'display') {
                let currency = (measure == 'total_ad_size') ? '' : '<span class="float-left">Rp</span>';
                let cellContent = '<div>' + currency + stringFormatNumber(total ?? 0) + '</div>';
                return cellContent;
            }
            return total;
        }
    });

    return columns;
}

/**
 * Get footer callback option 
 * 
 * @param {String} elementId 
 * @param {Array} dataHeaders 
 * @param {Array} items 
 * @param {String} measure 
 * @returns 
 */
function dtFooterCallback(elementId, dataHeaders, items, measure) {
    let columnTotals = [];
    for (let i = 0; i < dataHeaders.length; i++) {
        columnTotals[i] = items.reduce((total, item) => {
            return total + item.data[dataHeaders[i]][measure];
        }, 0);
    }

    return function ( row, data, start, end, display ) {
        let api = $(elementId).dataTable().api();
        let currency = (measure == 'total_ad_size') ? '' : '<span class="float-left">Rp</span>';
        for (let i = 0; i < columnTotals.length; i++) {
            let cellContent = '<div>' + currency + stringFormatNumber(columnTotals[i] ?? 0) + '</div>';
            cellContent += '<div class="font-small-2">' + totalDiffPercent(columnTotals, i) + '<div>';
            $(api.column(i+1).footer()).html(cellContent);
        }

        let totalSum = columnTotals.reduce((total, item) => {
            return total + item;
        }, 0);

        $(api.column(columnTotals.length+1).footer()).html('<div>' + currency + stringFormatNumber(totalSum) + '</div>');
    }
}


/**
 * Return difference precentage string for normal rows
 * 
 * @param {*} row 
 * @param {*} index 
 * @param {*} dataHeaders 
 * @param {*} measure 
 * @returns 
 */
function rowDiffPercent(row, index, dataHeaders, measure) {
    if (dataHeaders[index] == dataHeaders[0]) {
        return '-';
    } else {
        let currVal = row.data[dataHeaders[index]][measure];
        let prevVal = row.data[dataHeaders[index-1]][measure];
        return diffPercent(prevVal, currVal);
    };
}

/**
 * Return difference precentage string for total row
 * 
 * @param {*} columsTotal 
 * @param {*} index 
 * @returns 
 */
function totalDiffPercent(columsTotal, index) {
    if (index == 0) {
        return '-';
    } else {
        let currVal = columsTotal[index];
        let prevVal = columsTotal[index-1];
        return diffPercent(prevVal, currVal);
    };
}

/**
 * Return difference precentage string 
 * 
 * @param {*} prevVal 
 * @param {*} currVal 
 * @returns 
 */
function diffPercent(prevVal, currVal) {
    if (prevVal == 0) {
        if (currVal > 0) {
            return '<span class="text-success">' + feather.icons['arrow-up'].toSvg() + ' > 500 %</span>'
        } else {
            return '-';
        }
    } else {
        diff = currVal - prevVal;
        if (diff == 0) {    
            return '<span class="text-primary">=</span>'
        }
        icon = (diff >= 0) ? 'arrow-up' : 'arrow-down';
        color = (diff >= 0) ? 'success' : 'danger';

        let percent = diff / prevVal  * 100;
        if (percent > 500) {
            return '<span class="text-' + color + '">' + feather.icons[icon].toSvg() +  ' > 500 %</span>' ;
        } else {
            return '<span class="text-' + color + '">' + feather.icons[icon].toSvg() + ' ' + numberFormat(percent) + ' %</span>' ;
        }
    }
}