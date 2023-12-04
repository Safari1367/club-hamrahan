const sectionHeadings = document.querySelectorAll(
    "#content-single h2, #content-single h3"
);

const scrollList = document.querySelector(".scroll-list");

if (sectionHeadings && scrollList) {
    sectionHeadings.forEach((heading, index) => {

        // Create a random ID
        const randomId = "section-" + index;
        // console.log(randomId);

        // Assign the ID to the heading
        heading.id = randomId;

        // Assign the ID to headings h2 , h3 in the blog content
        const contentHeadings = document.querySelectorAll(
            "#content-single h2, #content-single h3"
        );
        contentHeadings[index].id = randomId;

        // Create a link in the quick access list
        const listItem = document.createElement("li");
        listItem.classList.add("list-group-item");

        if (contentHeadings[index].tagName === "H3") {
            listItem.classList.add("sub-li");
        }

        const link = document.createElement("a");
        link.classList.add("truncate-text-1");
        link.textContent = heading.textContent;
        link.href = "#" + randomId;
        link.addEventListener("click", (event) => {
            event.preventDefault();

            // Scroll smoothly to the target section
            document.querySelector(link.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
            });
        });

        listItem.appendChild(link);

        // Add the list item to both scrollList and scrollListMobile
        scrollList.appendChild(listItem);
        // scrollListMobile.appendChild(listItem.cloneNode(true));
    });

}

// ********************* copy text to clipboard
const discountCopyBtn = document.querySelector("#discount-copy-btn");
if (discountCopyBtn) {

    const discountCodeElement = document.getElementById('discount_code').getAttribute("data-copy");


    const tooltip = document.getElementById("tooltip");

    discountCopyBtn.addEventListener('click', () => {
        try {

            const textarea = document.createElement('textarea');
            textarea.value = discountCodeElement;
            document.body.appendChild(textarea);

            textarea.select();
            document.execCommand('copy');

            document.body.removeChild(textarea);

            tooltip.classList.add("show");

            setTimeout(() => {
                tooltip.classList.remove("show");

            }, 2000);
        } catch (err) {
            console.error("Failed to copy text: ", err);
        }
    });

}


// remove li from front page


const categoryElements = document.querySelectorAll('.front-page .betterdocs-single-category-wrapper');

if (categoryElements) {
    categoryElements.forEach(function (categoryElement) {

        const dataId = parseInt(categoryElement.getAttribute('data-id'));
        const betterdocsCounts = categoryElement.querySelector('.betterdocs-category-items-counts');
        const betterdocsIcon = categoryElement.querySelector('.betterdocs-category-icon');

        betterdocsCounts.remove();
        betterdocsIcon.remove();
        if (dataId > 7) {
            categoryElement.remove();

        }

    });
}


// ****************************************** like and dislike ajax script
jQuery(document).ready(function ($) {
    if ($("#discount-dislike") || $("#discount-like")) {

        //click on like btn
        $("#discount-like").on("click", function () {
            if (!$(this).hasClass("active")) {
                let currentValue2 = parseInt($("#like-value").text(), 10);
                handleLikeDislike("like", currentValue2);

                // add class and remove removeClass
                $(this).addClass("active");

                if ($("#discount-dislike").hasClass("active")) {
                    $("#discount-dislike").removeClass("active")
                }
            }
        });


        //click on dislike
        $("#discount-dislike").on("click", function () {
            if (!$(this).hasClass("active")) {
                let currentValue = parseInt($("#dislike-value").text(), 10);
                handleLikeDislike("dislike", currentValue);

                // add class and remove removeClass
                $(this).addClass("active");

                if ($("#discount-like").hasClass("active")) {
                    $("#discount-like").removeClass("active")
                }
            }

        });

        function handleLikeDislike(action, value) {
          

            let userId = $("#custom-like-dislike").data("user-id");
            let postId = $("#custom-like-dislike").data("post-id");
            let formEntryId = $("#custom-like-dislike").data("form-entry-id");


            //validate data
            function validateAllData(data) {

                if (isNaN(data['user_id']) && !data['user_id']) {
                    console.error("Error: User ID must be non-empty and numeric.");
                    return false;
                }

                if (isNaN(data['post_type_id']) && !data['post_type_id']) {
                    console.error("Error: Post ID must be non-empty and numeric.");
                    return false;
                }

                if (isNaN(data['form_entry_id']) && !data['form_entry_id']) {
                    console.error("Error: Form ID must be non-empty and numeric.");
                    return false;
                }



                return true;
            }


            let allData = {};

            allData['user_id'] = userId;
            allData['post_type_id'] = postId;
            allData['form_entry_id'] = formEntryId;
            allData['action'] = action;


            if (validateAllData(allData)) {
                // send info with ajax
                $.ajax({
                    url: ajax_var.url,
                    type: "post",
                    dataType: "json",
                    data: {
                        action: "post_type_like_dislike",
                        _nonce: ajax_var.nonce,
                        data: allData,
                    },
                    success: function (response) {

                        if (action === "like" && response['like_count'] >= 0) {

                            $("#like-value").text(value + 1);
                            // console.log(response);

                            if (response['dislike_count'] < 0 || response['dislike_count'] == 0) {
                                $("#dislike-value").text(0);
                            } else {
                                $("#dislike-value").text(response['dislike_count']);
                            }
                        }
                        if (action === "dislike" && response['dislike_count'] >= 0) {
                            // console.log(response);

                            $("#dislike-value").text(value + 1);

                            if (response['like_count'] < 0 || response['like_count'] == 0) {
                                $("#like-value").text(0);

                            } else {
                                $("#like-value").text(response['like_count']);
                            }



                        }

                    },
                    error: function (e) {
                        console.log(response);
                    },
                });

            }
        }
    }
});


// remove warning in user view for gravity view 
const userAsAdmin = document.querySelector('#user-is-admin');
const gvNotice = document.querySelector('.gv-notice');
if (!userAsAdmin && gvNotice) {
    gvNotice.remove();
}



