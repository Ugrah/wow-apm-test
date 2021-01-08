@extends('layouts.user')

@section('title') {{ config('app.name') }} - Process Design Managemnt @endsection


@section('content')
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

        <div class="container mt-2">
            <h2 class="text-default">
                <img src="{{ asset('img/confluence_l.png') }}" style="width: 180px;" class="mt-1">
                <button id="home-confluence" class="btn btn-light float-right" type="button">
                    <i class="material-icons text-muted vm">home</i>
                </button>
            </h2>
            <hr>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-4">
                        <div id="space-menu" class="card-body position-relative">
                            <ul class="nav flex-column">
                                <li class="nav-item menu-item">
                                    <a class="nav-link menu-item" data-id="107021132" data-type="page" href="#">
                                        <span class="direct-page"></span> TC1- Commercial outlook
                                    </a>
                                </li>
                                <li class="nav-item menu-item">
                                    <a class="nav-link menu-item" data-id="107021135" data-type="page" href="#">
                                        <span class="direct-page"></span> TC1- Terminal Description
                                    </a>
                                </li>
                                <li class="nav-item menu-item">
                                    <a class="nav-link menu-item" data-id="170887645" data-type="page" href="#">
                                        <span class="direct-page"></span> TC1-Terminal landscape
                                    </a>
                                </li>
                                <li class="nav-item menu-item">
                                    <a class="nav-link menu-item" data-id="170887648" data-type="page" href="#">
                                        <span class="direct-page"></span> TC1-Work instructions overview
                                    </a>
                                </li>
                                <li class="nav-item menu-item">
                                    <a class="nav-link menu-item" data-id="105152584" data-type="page" data-toggle="collapse" href="#collapse105152584">
                                        <span class="has-submenu"></span> TC1- Business processes
                                    </a>
                                </li>
                                <div id="collapse105152584" class="ml-4 panel-collapse collapse"></div>
                                <li class="nav-item menu-item">
                                    <a class="nav-link menu-item" data-id="170885771" data-type="page" href="#">
                                        <span class="direct-page"></span> TC1- WI Template Version3
                                    </a>
                                </li>
                                <li class="nav-item menu-item">
                                    <a class="nav-link menu-item" data-id="170625177" data-type="page" data-toggle="collapse" href="#collapse170625177">
                                        <span class="has-submenu"></span> Force of the Hoist slack rope fault
                                    </a>
                                </li>
                                <div id="collapse170625177" class="ml-4 panel-collapse collapse"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="container-fluid overflow-x-hidden">
            <div class="row">
                <div class="col-12">
                    <h3 class="page-title text-warning">APM Terminals Tangier</h3>
                    <div class="contentLayout2">
                        <div class="columnLayout single" data-layout="single">
                            <div class="cell normal" data-type="normal">
                                <div class="innerCell">
                                    <div class="confluence-information-macro confluence-information-macro-tip conf-macro output-block" data-hasbody="true" data-macro-name="tip">
                                        <p class="title">Welcome!</p><span class="aui-icon aui-icon-small aui-iconfont-approve confluence-information-macro-icon"> </span>
                                        <div class="confluence-information-macro-body">
                                            <p>This is the home page for APM Terminals Tangier space within Confluence. Team spaces are great for sharing knowledge and collaborating on projects, processes and procedures within your team.</p>
                                        </div>
                                    </div>
                                    <p>Next, you might want to:</p>
                                    <ul class="inline-task-list" data-inline-tasks-content-id="75170690">
                                        <li class="checked" data-inline-task-id="1"><strong>Customise the home page</strong> - Click "Edit" to start editing your home page</li>
                                        <li class="checked" data-inline-task-id="2"><strong>Create additional pages</strong> - Click "Create" to choose a blank page or template</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="columnLayout single" data-layout="single">
                            <div class="cell normal" data-type="normal">
                                <div class="innerCell">
                                    <h1 id="APMTerminalsTangier-SpaceforAPMTerminalsTangier"><strong>Space for APM Terminals Tangier</strong></h1>
                                    <p><span class="confluence-embedded-file-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image img-fluid" height="400" src="https://workdevclub.club/apm/confluenceApi/confluence_files/H13A0609.JPG" data-image-src="https://workdevclub.club/apm/confluenceApi/confluence_files/H13A0609.JPG" data-unresolved-comment-count="0" data-linked-resource-id="106825264" data-linked-resource-version="1" data-linked-resource-type="attachment" data-linked-resource-default-alias="H13A0609.JPG" data-base-url="https://confluence.apmterminals.com" data-linked-resource-content-type="image/jpeg" data-linked-resource-container-id="75170690" data-linked-resource-container-version="13"></span></p>
                                    <p class="APMTBody">This space is the Business Process Manual (BPM) for APM Terminals Tangier (TC1).</p>
                                    <p class="APMTBody">The intent of this space is to detail the main processes that APM Terminals Tangier will use in its daily business operations.</p>
                                    <p class="APMTBody">The document aims gathering and describing all business processes, regardless if these are directly linked to the operations, facilities, M&amp;R and to support functions.</p>
                                    <p class="APMTBody">The processes in the document are based on APM Terminals global standards, experience from other relevant terminals and the information gathered to date on the specific requirements for terminal operations in Morocco.</p>
                                    <p class="APMTBody">The content of the document is not to be considered final and is subject to further discussion and alignment between all involved parties.</p>
                                </div>
                            </div>
                        </div>
                        <div class="columnLayout two-right-sidebar" data-layout="two-right-sidebar">
                            <div class="cell normal" data-type="normal">
                                <div class="innerCell">
                                    <p><br></p>
                                    <h2 id="APMTerminalsTangier-Theteam">The team</h2>
                                    <div class="table-wrap">
                                        <table class="wrapped confluenceTable">
                                            <colgroup>
                                                <col>
                                                <col>
                                                <col>
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td class="confluenceTd">
                                                        <div class="content-wrapper">
                                                            <p style="text-align: center;"><a class="userLogoLink conf-macro output-inline" data-username="RTA053" href="https://confluence.apmterminals.com/display/~RTA053" title="" data-hasbody="false" data-macro-name="profile-picture"><img class="userLogo logo img-fluid" src="/images/icons/profilepics/default.svg" alt="User icon: RTA053" title=""></a></p>
                                                            <p style="text-align: center;"><strong><a href="mailto:Rajaa.Taidi@apmterminals.com" class="external-link" rel="nofollow">Taidi, Rajaa</a></strong></p>
                                                        </div>
                                                    </td>
                                                    <td class="confluenceTd">
                                                        <div class="content-wrapper">
                                                            <p style="text-align: center;"><a class="userLogoLink conf-macro output-inline" data-username="NBA032" href="https://confluence.apmterminals.com/display/~NBA032" title="" data-hasbody="false" data-macro-name="profile-picture"><img class="userLogo logo img-fluid" src="/download/attachments/13928625/user-avatar" alt="User icon: NBA032" title=""></a></p>
                                                            <p style="text-align: center;"><strong><a href="mailto:Nabil.Badilou@apmterminals.com" class="external-link" rel="nofollow">Badilou, Nabil</a></strong></p>
                                                        </div>
                                                    </td>
                                                    <td class="confluenceTd">
                                                        <div class="content-wrapper">
                                                            <p style="text-align: center;"><a class="userLogoLink conf-macro output-inline" data-username="VSI072" href="https://confluence.apmterminals.com/display/~VSI072" title="" data-hasbody="false" data-macro-name="profile-picture"><img class="userLogo logo img-fluid" src="/images/icons/profilepics/anonymous.svg" alt="User icon: VSI072" title=""></a></p>
                                                            <p style="text-align: center;"><strong><a href="mailto:vishnu.sivakumaran@apmterminals.com" class="external-link" rel="nofollow">Sivakumaran, Vishnu</a></strong></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="cell aside" data-type="aside">
                                <div class="innerCell">
                                    <p><br></p>
                                </div>
                            </div>
                        </div>
                        <div class="columnLayout single" data-layout="single">
                            <div class="cell normal" data-type="normal">
                                <div class="innerCell">
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="columnLayout two-right-sidebar" data-layout="two-right-sidebar">
                            <div class="cell normal" data-type="normal">
                                <div class="innerCell">
                                    <h2 id="APMTerminalsTangier-Blogstream">Blog stream</h2>
                                    <p>

                                    </p>
                                    <div class="blog-post macro-blank-experience conf-macro output-block" data-hasbody="false" data-macro-name="blog-posts">
                                        <h2>Blog stream</h2>
                                        <p>Create a blog post to share news and announcements with your team and company.</p>
                                        <button class="aui-button create-post">Create blog post</button>
                                    </div>
                                    <p></p>
                                </div>
                            </div>
                            <div class="cell aside" data-type="aside">
                                <div class="innerCell">
                                    <h2 id="APMTerminalsTangier-Recentlyupdated">Recently updated</h2>
                                    <p>

                                    </p>
                                    <div class="recently-updated recently-updated-concise conf-macro output-block" data-hasbody="false" data-macro-name="recently-updated">

                                        <div class="hidden parameters">
                                            <input type="hidden" id="changesUrl" value="/plugins/recently-updated/changes.action?theme=concise&amp;pageSize=10&amp;spaceKeys=TAN&amp;contentType=page, comment, blogpost, spacedesc">
                                        </div>
                                        <div class="results-container">
                                            <ul>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/display/TAN/APMT_TNG_OPS_EXE_Gate_+Gate+in+full_WI01_Receive+Full+for+Pre-Gate" title="APM Terminals Tangier">APMT_TNG_OPS_EXE_Gate_ Gate in full_WI01_Receive Full for Pre-Gate</a>

                                                        <div class="update-item-meta">
                                                            less than a minute ago<span class="separator"> • </span>created by <a class="confluence-userlink url fn" data-username="RTA053" href="/display/~RTA053">Rajaa Taidi</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/pages/viewpage.action?pageId=179340896" title="APM Terminals Tangier">APMT_TNG_OPS_EXE_Gate_WI03_Gate Export Empty (Booth)</a>

                                                        <div class="update-item-meta">
                                                            3 minutes ago<span class="separator"> • </span>updated by <a class="confluence-userlink url fn" data-username="ABE230" href="/display/~ABE230">Ayoub Bensbih</a><span class="separator"> • </span><a class="changes-link" href="/pages/diffpagesbyversion.action?pageId=179340896&amp;selectedPageVersions=2&amp;selectedPageVersions=1">view change</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/display/TAN/OUT-Gate+receive+empty+in+N4+WI" title="APM Terminals Tangier">OUT-Gate receive empty in N4 WI</a>

                                                        <div class="update-item-meta">
                                                            4 minutes ago<span class="separator"> • </span>updated by <a class="confluence-userlink url fn" data-username="ABE230" href="/display/~ABE230">Ayoub Bensbih</a><span class="separator"> • </span><a class="changes-link" href="/pages/diffpagesbyversion.action?pageId=179340908&amp;selectedPageVersions=2&amp;selectedPageVersions=1">view change</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/display/TAN/IN-Gate+receive+empty+in+XPS+WI" title="APM Terminals Tangier">IN-Gate receive empty in XPS WI</a>

                                                        <div class="update-item-meta">
                                                            4 minutes ago<span class="separator"> • </span>updated by <a class="confluence-userlink url fn" data-username="ABE230" href="/display/~ABE230">Ayoub Bensbih</a><span class="separator"> • </span><a class="changes-link" href="/pages/diffpagesbyversion.action?pageId=179340904&amp;selectedPageVersions=2&amp;selectedPageVersions=1">view change</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/pages/viewpage.action?pageId=179538184" title="APM Terminals Tangier">Plans the unit to TIP In XPS (2)</a>

                                                        <div class="update-item-meta">
                                                            11 minutes ago<span class="separator"> • </span>created by <a class="confluence-userlink url fn" data-username="RTA053" href="/display/~RTA053">Rajaa Taidi</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/display/TAN/IN-Gate+receive+empty+in+N4+WI" title="APM Terminals Tangier">IN-Gate receive empty in N4 WI</a>

                                                        <div class="update-item-meta">
                                                            14 minutes ago<span class="separator"> • </span>created by <a class="confluence-userlink url fn" data-username="ABE230" href="/display/~ABE230">Ayoub Bensbih</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/display/TAN/Create+the+booking+number+in+N4+WI" title="APM Terminals Tangier">Create the booking number in N4 WI</a>

                                                        <div class="update-item-meta">
                                                            25 minutes ago<span class="separator"> • </span>created by <a class="confluence-userlink url fn" data-username="RTA053" href="/display/~RTA053">Rajaa Taidi</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/display/TAN/search+the+RELEASE+ORDER+Wi" title="APM Terminals Tangier">search the RELEASE ORDER Wi</a>

                                                        <div class="update-item-meta">
                                                            30 minutes ago<span class="separator"> • </span>created by <a class="confluence-userlink url fn" data-username="RTA053" href="/display/~RTA053">Rajaa Taidi</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/pages/viewpage.action?pageId=179340883" title="APM Terminals Tangier">APMT_TNG_OPS_EXE_Gate_WI02_Gate Deliver Import Full (Pre-Gate)</a>

                                                        <div class="update-item-meta">
                                                            32 minutes ago<span class="separator"> • </span>updated by <a class="confluence-userlink url fn" data-username="ABE230" href="/display/~ABE230">Ayoub Bensbih</a><span class="separator"> • </span><a class="changes-link" href="/pages/diffpagesbyversion.action?pageId=179340883&amp;selectedPageVersions=2&amp;selectedPageVersions=1">view change</a> </div>
                                                    </div>
                                                </li>
                                                <li class="update-item">
                                                    <div class="update-item-icon">
                                                        <span class="aui-icon content-type-page"> </span>
                                                    </div>
                                                    <div class="update-item-content">
                                                        <a href="/display/TAN/Plans+the+unit+to+TIP++In+XPS" title="APM Terminals Tangier">Plans the unit to TIP In XPS</a>

                                                        <div class="update-item-meta">
                                                            33 minutes ago<span class="separator"> • </span>updated by <a class="confluence-userlink url fn" data-username="ABE230" href="/display/~ABE230">Ayoub Bensbih</a><span class="separator"> • </span><a class="changes-link" href="/pages/diffpagesbyversion.action?pageId=179340887&amp;selectedPageVersions=2&amp;selectedPageVersions=1">view change</a> </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="more-link-container">
                                                <a class="more-link" href="/plugins/recently-updated/changes.action?theme=concise&amp;pageSize=10&amp;startIndex=10&amp;searchToken=424985&amp;spaceKeys=TAN&amp;contentType=page, comment, blogpost, spacedesc">Show More</a>
                                                <img class="waiting-image img-fluid" alt="Please wait" src="/s/en_GB/7901/abf7b35644d5a5d1d7e4b0969a83e8eb2b569fb5/_/images/icons/wait.gif">
                                            </div>
                                        </div>
                                    </div>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection