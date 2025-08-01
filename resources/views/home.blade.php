@extends('layouts.app')

@section('content')
                    <div class="col-lg-8">
                <!-- Hot News Section -->
                <div class="mb-5">
                    <h3 class="category-title">Hot News</h3>
                    <div class="row">
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" class="card-img-top news-card-img" alt="Political Meeting">
                                <div class="card-body">
                                    <h6 class="card-title">Political Shakeup in Parliament</h6>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top news-card-img" alt="Stock Market">
                                <div class="card-body">
                                    <h6 class="card-title">Stock Market Hits Record High</h6>
                                    <small class="text-muted">5 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1575505586569-646b2ca898fc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1586&q=80" class="card-img-top news-card-img" alt="Medical Vaccine">
                                <div class="card-body">
                                    <h6 class="card-title">New Vaccine Approved</h6>
                                    <small class="text-muted">8 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top news-card-img" alt="Celebrity Couple">
                                <div class="card-body">
                                    <h6 class="card-title">Celebrity Wedding Announcement</h6>
                                    <small class="text-muted">10 hours ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ads Row -->
                <div class="row mb-5">
                    <div class="col-md-6 mb-3">
                        <div class="ad-box">
                            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Smartphone Ad">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="ad-box">
                            <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Coffee Ad">
                        </div>
                    </div>
                </div>

                <!-- Sports News Section -->
                <div class="mb-5">
                    <h3 class="category-title">Sports</h3>
                    <div class="row">
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1543357480-c60d400e7ef6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top news-card-img" alt="Soccer Match">
                                <div class="card-body">
                                    <h6 class="card-title">World Cup Qualifiers Results</h6>
                                    <small class="text-muted">Yesterday</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top news-card-img" alt="Olympic Pool">
                                <div class="card-body">
                                    <h6 class="card-title">Olympic Training Facilities</h6>
                                    <small class="text-muted">Yesterday</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1490&q=80" class="card-img-top news-card-img" alt="Basketball Player">
                                <div class="card-body">
                                    <h6 class="card-title">New Basketball Star Emerges</h6>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top news-card-img" alt="Tennis Player">
                                <div class="card-body">
                                    <h6 class="card-title">Tennis Championship Preview</h6>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technology News Section -->
                <div class="mb-5">
                    <h3 class="category-title">Technology</h3>
                    <div class="row">
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1567&q=80" class="card-img-top news-card-img" alt="New Smartphone">
                                <div class="card-body">
                                    <h6 class="card-title">New Smartphone Launch</h6>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1535378917042-10a22c95931a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1528&q=80" class="card-img-top news-card-img" alt="AI Technology">
                                <div class="card-body">
                                    <h6 class="card-title">AI Breakthrough in Medicine</h6>
                                    <small class="text-muted">4 days ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top news-card-img" alt="Cybersecurity">
                                <div class="card-body">
                                    <h6 class="card-title">Cybersecurity Threats Rise</h6>
                                    <small class="text-muted">4 days ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1583&q=80" class="card-img-top news-card-img" alt="Electric Car">
                                <div class="card-body">
                                    <h6 class="card-title">Future of Electric Vehicles</h6>
                                    <small class="text-muted">5 days ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
