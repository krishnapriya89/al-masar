<div class="modal fade SearchModal" id="SearchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-modal="false" role="dialog" 3>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <svg viewBox="0 0 24 24">
                            <path fill="#3E4152" fillrule="evenodd"
                                d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5">
                            </path>
                        </svg>
                    </button>
                    <div class="searchBox">
                        <form action="{{ route('product') }}" method="get">
                            <div class="form-group">
                                <input type="search" required class="form-control mob-main-search-input" name="search"
                                        id="search" placeholder="Search for Products" value="{{ @$keyword }}">
                                <button type="submit" class="sendBtn">
                                    <svg viewBox="0 0 612.01 612.01">
                                        <g>
                                            <g id="_x34__4_">
                                                <g>
                                                    <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
                                                        C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
                                                        l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
                                                        c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
                                                        S377.82,467.8,257.493,467.8z" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-body">
                    <ul class="results">
                        @include('frontend::includes.modal-search-product-list')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
