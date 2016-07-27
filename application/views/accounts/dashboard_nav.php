<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- The content container -->
<div id="contentAll">
    <div class="dashboard-nav-container col-md-3">
        <!-- The left navigation panel -->
        <div class="panel panel-primary">
            <!-- Navigation panel header -->
            <div class="panel-heading">
                <h3 class="panel-title">Navigasi Dashboard</h3>
            </div>
            <!-- Navigation panel body -->
            <div class="panel-body">
                <!-- Subpanel navigation for acara -->
                <a class="btn btn-default" href="<?php echo site_url() . 'akun/dashboard'; ?>">Profil Akun</a>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Acara</h3>
                    </div>
                    <div class="panel-body">
                        <div class="btn-group-vertical" role="group" aria-label="...">
                            <a class="btn btn-default" href="<?php echo site_url() . 'acara/seminar'; ?>">Seminar</a>
                            <a class="btn btn-default" href="<?php echo site_url() . 'acara/chemistry_fair_kids'; ?>">Chemistry Fair Kids</a>
                        </div>
                    </div>
                </div>
                <!-- Subpanel navigation for lomba -->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lomba</h3>
                    </div>
                    <div class="panel-body">
                        <div class="btn-group-vertical" role="group" aria-label="...">
                            <a class="btn btn-default" href="<?php echo site_url() . 'lomba/chemistry_competition'; ?>">Chemistry Competition</a>
                            <a class="btn btn-default" href="<?php echo site_url() . 'lomba/chemistry_innovation_project'; ?>">Chemistry Innovation Project</a>
                            <a class="btn btn-default" href="<?php echo site_url() . 'lomba/chemistry_art_competition'; ?>">Chemistry Art Competition</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

