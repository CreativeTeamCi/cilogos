if (typeof Object.create !== "function") {
    Object.create = function (obj) {
        function F() {
        }
        F.prototype = obj;
        return new F();
    };
}


(function ($, window, document) {

    var JsLocalSearch = {
        init: function (options, el) {
            var my = $(el);
            var base = this;



         if (options==undefined)  {options={}}

            var searchinput = (options.searchinput==undefined) ? "#gsearchsimple" : options.searchinput;
            options.container = (options.container==undefined) ? "contsearch" : options.container;
            var containersearch =  (options.containersearch==undefined) ? "gsearch" : options.containersearch;
            var mincaracteres =   (options.mincaracteres==undefined) ? 3 : options.mincaracteres;
            var action = (options.action==undefined) ? "Show" : options.action;
            var info = (options.info==undefined) ? false : options.info;
            options.mark_text =   (options.mark_text==undefined) ? false : options.mark_text;
            options.html_search =   (options.html_search==undefined) ? true : options.html_search;



            $(el).hide();

            var actionObject = Object.create(eval("Action" + action));

            actionObject.init(options, this)
            $(searchinput).keyup(
                    function (event) {
                        event.preventDefault();
                        txt = $(searchinput).val()
                        $('.' + options.container).attr('data-show',0)


                        if (info) {
                            $(el).show();
                        }
                        if ($(searchinput).val().length >= mincaracteres) {
                            actionObject.zero(this)
                            total = 0
                            totalok = 0
                            totalko = 0


                            $("." + options.container).each(function () {
                                visible=false
                                total++
                                $(this).find("." + containersearch).each(function () {
                                if (visible !=true) {

                                    visible=base.busca(options, actionObject, this);
                                }

                            });

                            if (visible == true) {
                                actionObject.ok(this);
                                totalok++
                            } else
                            {
                                actionObject.ko(this);
                                totalko++
                            }

                            });



                            $(el).find('.total').html(total);
                            $(el).find('.number').html(totalok);
                            $(el).find('.numberno').html(totalko);

                        } else {
                            $(el).hide();
                            actionObject.nope();
                            $("." + options.container).find("." + containersearch).each(function () {
                                if (options.mark_text != undefined) {
                                var re = new RegExp('<span class="'+options.mark_text+'">(.*?)<\/span>', "gi");
                                  var str = $(this).html();
                                  var newstr = str.replace(re, "$1");
                              }
                                  $(this).html(newstr);
                            });


                        }


                    })


        },

        busca: function (options, actionObject, el) {


            if (options.mark_text != undefined) {
            var re = new RegExp('<span class="'+options.mark_text+'">(.*?)<\/span>', "gi");
            var str = $(el).html();
            var newstr = str.replace(re, "$1");
            $(el).html(newstr);
            }

            search = false;

            if (options.html_search)

                if ($(el).text().normalize('NFD').replace(/([aeio])\u0301|(u)[\u0301\u0308]/gi,"$1$2").normalize().toUpperCase().indexOf(txt.normalize('NFD').replace(/([aeio])\u0301|(u)[\u0301\u0308]/gi,"$1$2").normalize().toUpperCase()) != -1) {
                    search = true;
                    console.log(1)
                    var re = new RegExp("(" + txt + ")", "gi");
                    var str = $(el).text();

                    if (options.mark_text != undefined) {
                    var newstr = str.replace(re, "<span class='"+options.mark_text+"'>$1</span>");
                    }
                    $(el).html(newstr);


                }

            if ($(el).attr('data-description') != undefined && options.description_search) {
                if ($(el).attr('data-description').toUpperCase().indexOf(txt.toUpperCase()) != -1) {
                    search = true;



                }
            }

            if ($(el).attr('data-keywords') != undefined && options.keyword_search) {

                keywords = $(el).attr('data-keywords').toUpperCase().split(",")
                searchKey = txt.toUpperCase().split(" ")


                $.each(keywords, function (index, value) {
                    $.each(searchKey, function (index, key) {
                        if (value == key) {
                            search = true;
                        }
                    });
                });



            }



            return search;
        }
    };

    var ActionShow = {

        init: function (options, el) {
            this.container = options.container;
        },
        zero: function (options, el) {
            $('.' + this.container).hide();
        },
        ok: function (t) {
            $(t).closest('.' + this.container).show();
            $(t).closest('.' + this.container).attr('data-show',1);


        },
        ko: function (t) {
            if ($(t).closest('.' + this.container).attr('show')!=1) {
            $(t).closest('.' + this.container).hide();
        }

        },
        nope: function () {
            $('.' + this.container).show();

        }
    }

    var ActionMark = {

        init: function (options, el) {
            this.container = options.container;
            this.mark = options.actionok;
            this.unmark = options.actionko;
        },
        zero: function (options, el) {
            $('.' + this.container).removeClass(this.mark);
            $('.' + this.container).removeClass(this.unmark);

        },
        ok: function (t) {
            $(t).closest('.' + this.container).removeClass(this.unmark);
            $(t).closest('.' + this.container).addClass(this.mark);
             $(t).closest('.' + this.container).attr('data-show',1);
        },
        ko: function (t) {
            if ($(t).closest('.' + this.container).attr('data-show')!=1) {
                $(t).closest('.' + this.container).removeClass(this.mark);
                $(t).closest('.' + this.container).addClass(this.unmark);
              }

        },
        nope: function () {
            $('.' + this.container).removeClass(this.mark);
            $('.' + this.container).removeClass(this.unmark);

        }
    }


    $.fn.jsLocalSearch = function (options) {
        return this.each(function () {

            var jsLocalSearch = Object.create(JsLocalSearch);
            var actionShow = Object.create(ActionShow);
            jsLocalSearch.init(options, this);

            //     $.data(this, "jsLocalSearch", jsLocalSearch);
        });
    };



}(jQuery, window, document));

