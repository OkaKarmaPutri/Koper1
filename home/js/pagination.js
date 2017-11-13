var Imtech = {};
Imtech.Pager = function() {
    this.paragraphsPerPage = 3;
    this.currentPage = 1;
    this.pagingControlsContainer = '#pagingControls';
    this.pagingContainerPath = '#content';
    this.numPages = function() {
        var numPages = 0;
        if (this.paragraphs != null && this.paragraphsPerPage != null) {
            numPages = Math.ceil(this.paragraphs.length / this.paragraphsPerPage);
        }
        return numPages;
    };
    this.showPage = function(page) {
        this.currentPage = page;
        var html = '';
        this.paragraphs.slice((page-1) * this.paragraphsPerPage,
            ((page-1)*this.paragraphsPerPage) + this.paragraphsPerPage).each(function() {
            html += '<div>' + $(this).html() + '</div>';
        });
        $(this.pagingContainerPath).html(html);
        renderControls(this.pagingControlsContainer, this.currentPage, this.numPages());
    }
    var renderControls = function(container, currentPage, numPages) {
        var pagingControls = '<a href="#" onclick="pager.showPage(' + 1 + '); return false;">&laquo;</a>', i = 1;
        if(currentPage >= 4)
            i = currentPage - 2;
        if(currentPage + 1 >= numPages && numPages >= 5)
            i = numPages - 4;
        if(numPages <= 5)
            j = numPages;
        else
            j = i + 4;
        for (i ; i <= j; i++) {
            if (i != currentPage) {
                pagingControls += '<a href="#" onclick="pager.showPage(' + i + '); return false;">' + i + '</a>';
            } else {
                pagingControls += '<a href="#" onclick="pager.showPage(' + i + '); return false;" class="active">' + i + '</a>';
            }
        }
        pagingControls += '<a href="#" onclick="pager.showPage(' + numPages + '); return false;">&raquo;</a>';
        $(container).html(pagingControls);
    }
}