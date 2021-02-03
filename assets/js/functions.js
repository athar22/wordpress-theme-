//    _____      _     _            _      _     _         _         _
//   / ____|    (_)   | |   ___    | |    (_)   | |       | |       | |
//  | |  __ _ __ _  __| |  ( _ )   | |     _ ___| |_   ___| |_ _   _| | ___
//  | | |_ | '__| |/ _` |  / _ \/\ | |    | / __| __| / __| __| | | | |/ _ \
//  | |__| | |  | | (_| | | (_>  < | |____| \__ \ |_  \__ \ |_| |_| | |  __/
//   \_____|_|  |_|\__,_|  \___/\/ |______|_|___/\__| |___/\__|\__, |_|\___|
//                                                              __/ |
//                                                             |___/
// Grid & List style
$(".EBAMembers .options .grid").click(function () {
    // set
    $(".EBAMembers .options .grid").addClass("active");
    $(".EBAMembers .membersContainer > div").addClass(
        "col-lg-4 col-md-6 col-sm-12"
    );

    // remove
    $(".EBAMembers .options .list").removeClass("active");
    $(".EBAMembers .membersContainer > div").removeClass("col-12");
    $(".EBAMembers .membersContainer > div .memberItem").removeClass("row m-0");
    $(".EBAMembers .membersContainer > div .memberItem").css("display", "block");
    $(".EBAMembers .memberItem").css("min-height", "330px");
    $(".EBAMembers .membersContainer > div .avatarImageContainer").removeClass(
        "col-12 col-sm-3 p-0"
    );
    $(".EBAMembers .membersContainer > div .avatarImage").css("height", "250px");
    $(".EBAMembers .membersContainer > div .infoContainer").removeClass(
        "col-12 col-sm-9 p-4"
    );
    $(
        ".EBAMembers .membersContainer > div .infoContainer .contactOptions"
    ).addClass("col");
    $(".EBAMembers .membersContainer > div .infoContainer .contactOptions").css(
        "margin-left",
        "unset"
    );
    $(".EBAMembers .membersContainer > div .infoContainer .btn").css(
        "margin",
        "auto"
    );
});

$(".EBAMembers .options .list").click(function () {
    // set
    $(".EBAMembers .options .list").addClass("active");
    $(".EBAMembers .membersContainer > div").addClass("col-12");
    $(".EBAMembers .membersContainer > div .memberItem").addClass("row m-0");
    $(".EBAMembers .membersContainer > div .memberItem").css("display", "flex");
    $(".EBAMembers .memberItem").css("min-height", "unset");
    $(".EBAMembers .membersContainer > div .avatarImageContainer").addClass(
        "col-12 col-sm-3 p-0"
    );
    $(".EBAMembers .membersContainer > div .avatarImage").css("height", "100%");
    $(".EBAMembers .membersContainer > div .infoContainer").addClass(
        "col-12 col-sm-9 p-4"
    );
    $(
        ".EBAMembers .membersContainer > div .infoContainer .contactOptions"
    ).removeClass("col");
    $(".EBAMembers .membersContainer > div .infoContainer .contactOptions").css(
        "margin-left",
        "auto"
    );
    $(".EBAMembers .membersContainer > div .infoContainer .btn").css(
        "margin",
        "0"
    );

    // remove
    $(".EBAMembers .options .grid").removeClass("active");
    $(".EBAMembers .membersContainer > div").removeClass(
        "col-lg-4 col-md-6 col-sm-12"
    );
});

$(".EBAMembers .membersContainer").bind("DOMSubtreeModified", function (event) {
    console.log("Something has changed inside .classname or #id");
});