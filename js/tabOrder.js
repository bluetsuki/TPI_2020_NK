/**
 * @author Benzonana Alexandre
 * Modify Nguyen Kelly
 * @version 1.0
 */

var order = [];
var filter = [];

var page = 1;
var resultLimit = 20;

const DOWN_ICON = '<svg class="bi bi-arrow-down" width="1em" height="1em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M4.646 9.646a.5.5 0 01.708 0L8 12.293l2.646-2.647a.5.5 0 01.708.708l-3 3a.5.5 0 01-.708 0l-3-3a.5.5 0 010-.708z" clip-rule="evenodd"/> <path fill-rule="evenodd" d="M8 2.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V3a.5.5 0 01.5-.5z" clip-rule="evenodd"/> </svg>'

const UP_ICON = '<svg class="bi bi-arrow-up" width="1em" height="1em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/> <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z" clip-rule="evenodd"/> </svg>'

reorder();

/**
 * Add orders columns in function of user actions
 * @param {string} col
 */
function setOrder(col) {
    resetColName();
    if (!(event.shiftKey && event.ctrlKey)) {

        if (event.shiftKey) {
            var inverted = false;
            //search item in array
            for (var i = 0; i < order.length; i++) {
                if (order[i][0] == col.id) {
                    //remove item if in array
                    if (order[i][1] == "ASC") {
                        order[i] = [order[i][0], "DESC"]
                    } else {
                        order[i] = [order[i][0], "ASC"]
                    }
                    inverted = true;
                }
            }
            if (!inverted) {
                order.push([col.id, 'DESC']);
            }

        } else if (event.ctrlKey) {

            var removed = false;
            //check if array contain item
            for (var i = 0; i < order.length; i++) {
                if (order[i][0] == col.id) {
                    //remove item if in array
                    order.splice(i, 1);
                    removed = true;
                }
            }
            //if not in array add item to array
            if (!removed) {
                order.push([col.id, 'ASC']);
            }

        } else {
            //clear array + add clicked item
            order = [];
            order.push([col.id, 'ASC'])
        }
    }
    setColName();
    reorder();
}

/**
 * Send request to php script to get the datas filtered and ordered
 */
function reorder() {

    if (order.length > 0) {
        var jsonOrder = JSON.stringify(order);
        var url = 'model/tabTPI.php?order=' + jsonOrder + "&page=" + page + "&limit=" + resultLimit;
    } else {
        var jsonOrder = JSON.stringify(order);
        var url = 'model/tabTPI.php?page=' + page + "&limit=" + resultLimit;
    }

    if (Object.keys(filter).length > 0) {
        var jsonFilter = JSON.stringify(filter);
        url += "&filter=" + jsonFilter;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("dataContainer").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}


/**
 * Change columns name and add arrow to know order
 */
function setColName() {
    if (order.length > 0) {
        for (var i = 0; i < order.length; i++) {
            if (order[i][1] == "ASC") {
                document.getElementById(order[i][0]).innerHTML = document.getElementById(order[i][0]).textContent + UP_ICON + "<small>" + (i + 1) + "</small>";
            } else {
                document.getElementById(order[i][0]).innerHTML = document.getElementById(order[i][0]).textContent + DOWN_ICON + "<small>" + (i + 1) + "</small>";
            }
        }
    } else {
        resetColName();
    }
}

/**
 * Reset columns names
 */
function resetColName() {
    document.getElementById('colName').innerHTML = document.getElementById('colNameModel').innerHTML;
}

/**
 * add filters to filter array
 */
function updateFilter() {
    filter = {};
    for (var i = 0; i < document.getElementById('form').childElementCount; i++) {
        var filterForm = document.getElementById('form').children[i];
        var field = filterForm.children[0].value;
        if (field in filter) {
            filter[field].push(
                [filterForm.children[1].value, filterForm.children[2].value]
            );
        } else {
            filter[field] = [
                [filterForm.children[1].value, filterForm.children[2].value]
            ];
        }
    }
    reorder();
}

/**
 * add filter form for user to make new filter
 */
function addFilter() {
    form = document.getElementById('model').cloneNode(true);
    form.id = "";
    document.getElementById("form").append(form);
}

/**
 * remove the filter form
 * @param html element form
 */
function removeFilter(filter) {
    filter.remove();
    updateFilter();
}
