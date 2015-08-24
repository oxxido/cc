/**
 * @license jQuery paging plugin v1.1.1 21/06/2014
 * http://www.xarg.org/2011/09/jquery-pagination-revised/
 *
 * Copyright (c) 2011, Robert Eisele (robert@xarg.org)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 **/

(function($) {

    $["fn"]["easyPaging"] = function(o) {

        if (!$["fn"]["paging"]) {
            return this;
        }

        // Normal Paging config
        var opts = {
            "perpage": 10,
            "elements": 0,
            "page": 1,
            "format": "",
            "lapping": 0,
            "onSelect": function() {
            }
        };

        $["extend"](opts, o || {});

        var $li = $("li", this);

        var masks = {};

        $li.each(function(i) {

            if (0 === i) {
                masks.prev = this.innerHTML;
                opts.format += "<";
            } else if (i + 1 === $li.length) {
                masks.next = this.innerHTML;
                opts.format += ">";
            } else {
                masks[i] = this.innerHTML.replace(/#[nc]/, function(str) {
                    opts["format"] += str.replace("#", "");
                    return "([...])";
                });
            }
        });

        opts["onFormat"] = function(type) {

            var value = "";

            switch (type) {
                case 'block':

                    value = masks[this["pos"]].replace("([...])", this["value"]);

                    if (!this['active'])
                    {
                        return '<li class="disabled"><a href="#">' + value + '</a></li>';
                    }
                    if (this["page"] !== this["value"])
                    {
                        return '<li><a href="#' + this["value"] + '">' + value + '</a></li>';
                    }
                    return '<li class="active"><a href="#">' + value + '<span class="sr-only">(current)</span></a></li>';

                case 'next':
                    if (!this['active'])
                    {
                        return '<li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                    }
                    return '<li><a href="#' + this["value"] + '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';

                case 'prev':
                    if (!this['active'])
                    {
                        return '<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                    }
                    return '<li><a href="#' + this["value"] + '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
            }
        };

        $(this)["paging"](opts['total'], opts);
        
        return this;
    };

}(jQuery));
