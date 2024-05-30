<template>
  <div>
    <!--=================================
Banner -->
    <section class="clearfix slider-banner">
      <div id="slider" class="carousel slide custom-carousle-bs" data-ride="carousel">
        <!-- Pagina -->
        <ol class="carousel-indicators">
          <li data-target="#slider" data-slide-to="0" class="active"></li>
          <li data-target="#slider" data-slide-to="1"></li>
          <li data-target="#slider" data-slide-to="2"></li>
        </ol>
        <!-- End Pagina -->

        <div class="carousel-inner">
          <!-- slider item -->
          <div class="carousel-item active">
            <img class="img-fluid w-100" src="/assets/img/top-banner-01.jpg" alt="banner" />
            <div class="slider-content">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-7 justify-content-center text-center">
                    <h2 class="text-white animated-08 font-weight-bold">DXのプロのための案件紹介サービス</h2>
                    <h6 class="font-weight-normal text-white animated-08 pt-lg-5">
                      <span>大企業・ベンチャー企業のDXプロジェクトに参画してみませんか？</span>
                      <span>プライムDXは、先進技術を活用したプロジェクト、新規事業の立ち上げ、</span>
                      <span>企業変革などワクワクするような案件をあなたにご紹介します！</span>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-caption slider-bottom d-none d-sm-block" v-if="!isLogin">
              <div class="row pb-3 pb-md-5">
                <div class="col-6 text-right">
                  <a href="/register" class="btn orange-btn btn-sm animated-07 text-blue font-weight-normal mr-1">
                    <i class="fas fa-user-edit pr-2"></i> 無料登録はこちら
                  </a>
                </div>
                <div class="col-6 text-left">
                  <a href="/login" class="btn blue-btn btn-sm animated-07 font-weight-normal ml-1">
                    <i class="fas fa-sign-in-alt pr-2"></i> ログイン
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End slider item -->

          <!-- slider item -->
          <div class="carousel-item">
            <img class="img-fluid w-100" src="/assets/img/top-banner-02-new.png" alt="banner" />
            <div class="slider-content">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-7 justify-content-center text-center">
                    <h2 class="text-white animated-08 font-weight-bold">DXのプロのための案件紹介サービス</h2>
                    <h6 class="font-weight-normal text-white animated-08 pt-lg-5">
                      <span>大企業・ベンチャー企業のDXプロジェクトに参画してみませんか？</span>
                      <span>プライムDXは、先進技術を活用したプロジェクト、新規事業の立ち上げ、</span>
                      <span>企業変革などワクワクするような案件をあなたにご紹介します！</span>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-caption slider-bottom d-none d-sm-block" v-if="!isLogin">
              <div class="row pb-3 pb-md-5">
                <div class="col-6 text-right">
                  <a href="#!" class="btn orange-btn btn-sm animated-07 text-blue font-weight-normal mr-1">
                    <i class="fas fa-user-edit pr-2"></i> 無料登録はこちら
                  </a>
                </div>
                <div class="col-6 text-left">
                  <a href="#!" class="btn blue-btn btn-sm animated-07 font-weight-normal ml-1">
                    <i class="fas fa-sign-in-alt pr-2"></i> ログイン
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End slider item -->

          <!-- slider item -->
          <div class="carousel-item">
            <img class="img-fluid w-100" src="/assets/img/top-banner-03.jpg" alt="banner" />
            <div class="slider-content">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-7 justify-content-center text-center">
                    <h2 class="text-white animated-08 font-weight-bold">DXのプロのための案件紹介サービス</h2>
                    <h6 class="font-weight-normal text-white animated-08 pt-lg-5">
                      <span>大企業・ベンチャー企業のDXプロジェクトに参画してみませんか？</span>
                      <span>プライムDXは、先進技術を活用したプロジェクト、新規事業の立ち上げ、</span>
                      <span>企業変革などワクワクするような案件をあなたにご紹介します！</span>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-caption slider-bottom d-none d-sm-block" v-if="!isLogin">
              <div class="row pb-3 pb-md-5">
                <div class="col-6 text-right">
                  <a href="#!" class="btn orange-btn btn-sm animated-07 text-blue font-weight-normal mr-1">
                    <i class="fas fa-user-edit pr-2"></i> 無料登録はこちら
                  </a>
                </div>
                <div class="col-6 text-left">
                  <a href="#!" class="btn blue-btn btn-sm animated-07 font-weight-normal ml-1">
                    <i class="fas fa-sign-in-alt pr-2"></i> ログイン
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End slider item -->
        </div>

        <!-- Control carousel -->
        <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <!-- End Control carousel -->
      </div>
    </section>
    <!--=================================
End Banner -->

    <!--=================================
Feature box -->
    <section class="custom-space-ptb">
      <div class="container">
        <!-- Row -->
        <div class="row">
          <!-- Title -->
          <div class="col-12 justify-content-center">
            <div class="section-title center custom-title">
              <h2 class="title text-blue">
                <span class="position-relative pl-4 pr-4">PrimeDX３つの特徴</span>
              </h2>
            </div>
          </div>
          <!-- End Title -->
        </div>
        <!-- End Row -->

        <!-- Row -->
        <div class="row pt-2 pb-4">
          <!-- Col 04 -->
          <div class="col-md-4 mb-4">
            <div class="feature-box-item p-xl-2 p-2 text-center">
              <div class="feature-info-icon mb-4">
                <img src="/assets/img/time-icon.png" alt="週10時間からDXプロジェクトに 参画できる！" class="img-fluid" />
              </div>
              <div class="feature-info-content">
                <h5 class="text-blue mb-4">週10時間からDXプロジェクトに 参画できる！</h5>
                <p class="mb-0 text-dark">AI、ブロックチェーン、企業変革などあなたが興味がある分野の案件・プロジェクトについて週10時間から参画できます！</p>
              </div>
            </div>
          </div>
          <!-- End Col 04 -->

          <!-- Col 04 -->
          <div class="col-md-4 mb-4">
            <div class="feature-box-item p-xl-2 p-2 text-center">
              <div class="feature-info-icon mb-4">
                <img src="/assets/img/project-icon.png" alt="“DX責任者との強いパイプライン” 独自の非公開案件も多数。" class="img-fluid" />
              </div>
              <div class="feature-info-content">
                <h5 class="text-blue mb-4">“DX責任者との強いパイプライン” 独自の非公開案件も多数。</h5>
                <p class="mb-0 text-dark">名の知れた大企業ベンチャー企業での非公開のDX案件に参画できることは、あなたのキャリアアップにつながります！</p>
              </div>
            </div>
          </div>
          <!-- End Col 04 -->

          <!-- Col 04 -->
          <div class="col-md-4 mb-4">
            <div class="feature-box-item p-xl-2 p-2 text-center">
              <div class="feature-info-icon mb-4">
                <img src="/assets/img/support-icon.png" alt="DX専属のコンシェルジュによる充実サポート！" class="img-fluid" />
              </div>
              <div class="feature-info-content">
                <h5 class="text-blue mb-4">DX専属のコンシェルジュによる充実サポート！</h5>
                <p class="mb-0 text-dark">PrimeDXを運営しているプライムスタイルでは、多くのAI、ブロックチェーン、産学連携案件を行ってます。DXに精通しているコンシェルジュがあなたのスキルや要望にあった案件を紹介します！</p>
              </div>
            </div>
          </div>
          <!-- End Col 04 -->
        </div>
        <!-- End Row -->
      </div>
    </section>
    <!--=================================
End Feature box -->

    <!--=================================
Past cases  -->
    <section class="custom-space-ptb bg-light past-cases">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- Title -->
            <div class="section-title center custom-title">
              <h2 class="title text-blue">
                <span class="position-relative pl-4 pr-4">過去案件事例</span>
              </h2>
            </div>
            <!-- End Title -->

            <!-- Row -->
            <div class="row">
              <!-- Col 04 -->
              <div class="col-12 mb-4">
                <div class="job-list position-relative shadow-none border-0">
                  <div class="job-list-details border-0">
                    <div class="job-list-info">
                      <div class="job-list-title">
                        <h5 class="mb-3"><a href="#!" class="text-blue hover-color-blue">AIモデル動的評価ツールプロジェクト </a></h5>
                      </div>
                      <p class="text-dark">
                        今までは、データサイエンティストの感覚によって、アルゴリズムやハイパーパラメーター（人の手で調整する必がある変 数）を選定していましたが、それを当該プロジェクトによって、マシンパワーを活⾊して実施することで改善することができた。
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Col 04 -->

              <!-- Col 04 -->
              <div class="col-12 mb-4">
                <div class="job-list position-relative shadow-none border-0">
                  <div class="job-list-details border-0">
                    <div class="job-list-info">
                      <div class="job-list-title">
                        <h5 class="mb-3"><a href="#!" class="text-blue hover-color-blue">アパレル自動ラベリングプロジェクト </a></h5>
                      </div>
                      <p class="text-dark">
                        某大手アパレルECモールは手動でタグづけを⾊っており、莫大な⾊数消費と網羅性に課題がある。画像解析から服のタイプや⾊、柄、サイズな どを判定しDBに格納し、ユーザーが欲しい商品を提案するサービスを開発
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Col 04 -->

              <!-- Col 04 -->
              <div class="col-12 mb-4">
                <div class="job-list position-relative shadow-none border-0">
                  <div class="job-list-details border-0">
                    <div class="job-list-info">
                      <div class="job-list-title">
                        <h5 class="mb-3 text-blue"><a href="#!" class="text-blue hover-color-blue">自動Q&A生成支援システム開発プロジェクト </a></h5>
                      </div>
                      <p class="text-dark">
                        社内にある膨大な資料から自動的にQ＆Aの生成を実施するシステムのPOCを実施
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Col 04 -->
            </div>
            <!-- End Row -->
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Past cases -->

    <!--=================================
    Project example  -->
    <section class="custom-space-ptb bg-blue project-example">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <!-- Title -->
            <div class="section-title center custom-title pt-3">
              <h2 class="title text-white">
                <span class="position-relative pl-4 pr-4">ご紹介案件例</span>
              </h2>
              <h3 class="text-white pt-2">「ご登録いただいた方にのみ」ご紹介可能の非公開案件が多数！</h3>
            </div>
            <!-- End Title -->

            <!-- Row -->
            <div class="row">	
              <!-- col 06 -->	
              <div class="col-md-6" v-for="(job, key) in jobs" v-bind:key="key">	
                <div class="job-list job-grid custom-job-list m-lg-3">	
                  <div class="job-list-img job-hot mb-4">	
                    <a :href="'/job/' + job.id" :title="job.job_title">	
                      <img onerror="this.src='/assets/img/top-job-img.png'" class="img-fluid" :src="job.images ? job.images : '/assets/img/top-job-img.png'" alt="img" />	
                    </a>	
                  </div>	
                  <div class="job-list-details text-left">	
                    <div class="job-list-info">	
                      <div class="job-list-title mb-4">	
                        <h5 class="mb-0"><a :href="'/job/' + job.id" :title="job.job_title" class="text-dark">{{ job.job_title }}</a></h5>	
                      </div>	
                      <div class="job-list-text pb-1">	
                        <p class="text-dark" v-html="job.recruitment_overview"></p>	
                      </div>	
                      <div class="job-list-option">	
                        <p @click="searchJobByCategory(job.category)" style="cursor: pointer;">	
                          <i class="fas fa-shopping-bag pr-1"></i>	
                          <span class="text-blue-sky">{{ job.category ? job.category.name : "" }}</span>	
                        </p>	
                        <p @click="searchJobByStyle(job.style)" style="cursor: pointer;">	
                          <i class="fas fa-clock pr-1"></i>	
                          <span class="text-blue-sky">	
                            {{ job.style ? job.style.name : "" }}	
                          </span>	
                        </p>	
                      </div>	
                    </div>	
                  </div>	
                  <div class="job-list-favourite-time">	
                    <a href="javascript:void(0)" v-on:click="like(job.id, key)" class="job-list-favourite order-2">	
                      <i :class="'fas fa-heart' + (job.liked ? ' text-danger' : '')"></i></a>	
                    <span class="job-list-time order-1">	
                      <button type="button" @click="onClickApply(job.id)" class="btn white-btn blue-border text-blue">エントリーする</button>	
                    </span>	
                  </div>	
                </div>	
              </div>	
              <!-- End col 06 -->	
            </div>	
            <!-- End Row -->
          </div>
          
        </div>
      </div>
    </section>
    <!--=================================
    End Project example  -->

    <!--=================================
Register  -->
    <section class="custom-space-ptb bg-orange pd-0" v-if="!isLogin">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center py-4">
            <h2 class="text-white mb-4">希望条件に合った案件をお探すの方</h2>
            <a class="btn white-btn border-white btn-lg shadow text-blue custom-regis-btn" href="/register"><i class="fas fa-sign-in-alt pr-md-5"></i> 無料登録はこちら</a>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Register  -->

    <!--=================================
Service  -->
    <section class="custom-space-ptb bg-light custom-service">
      <div class="container">
        <div class="justify-content-center">
          <div class="section-title center custom-title">
            <h2 class="title text-blue">
              <span class="position-relative pl-4 pr-4">サービスの流れ</span>
            </h2>
          </div>
          <div class="text-center">
            <img class="img-fluid mt-lg-4 mt-sm-3" src="/assets/img/service-img.png" alt="サービスの流れ" />
          </div>
          <div class="feature-info-02 p-4 p-lg-5 bg-white m-4 position-relative blue-border rounded" v-if="!isLogin">
            <div class="feature-info-title bg-blue text-white">
              簡単1分で無料会員登録
            </div>
            <div class="feature-info-content text-dark">
              <p class="mb-0 font-weight-bold text-blue">コンシェルジュとの面談 興味のあるお仕事に応募書類の書き方、</p>
              <p class="mb-0 font-weight-bold text-blue">契約・仕事スタートエントリーしましょう面接ノウハウも丁寧にアドバイス</p>
            </div>
            <a class="ml-auto align-self-center btn orange-btn shadow" href="/register">無料登録はこちら</a>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Service  -->

    <!--=================================
Voices of people  -->
    <section class="custom-space-ptb">
      <div class="container">
        <div class="row">
          <div class="col-md-12 justify-content-center">
            <div class="section-title center custom-title">
              <h2 class="title text-blue">
                <span class="position-relative pl-4 pr-4">プロジェクトに係わった方々の声</span>
              </h2>
              <div class="mt-4 text-dark">
                <p class="mt-0">プライムDXでは先進的なプロジェクトを中心にご紹介してます</p>
                <p class="mt-0">ワクワクするような案件が多数あります。</p>
              </div>
            </div>
          </div>
        </div>
        <div class="p-3 pl-sm-5 pr-sm-5">
          <!-- Row -->
          <div class="vp row mb-5">
            <div class="vp-img col-md-3 col-lg-2 text-center">
              <p class="text-blue">
                <img src="/assets/img/avatar-people01.png" alt="B氏" class="img-fluid" />
                <b class="p-1 d-block">B氏</b>
              </p>
            </div>
            <div class="vp-details col-md-9 col-lg-9 shadow rounded ml-lg-5">
              <div class="job-list-info">
                <div class="job-list-option pt-3 pb-5 text-dark">
                  私は、ITの先端技術であるAIに関するプロジェクトを推進してきました。具体的には、画像認識、自然言語処理に関して、AIをいかに活用するかどうかを検証してきました。データサイエンティストとして、AI技術の中でやり取りされるデータを解析し、現状の技術の問題点を洗い出し、より優れたシステムを構築するという一連の流れを繰り返しながら、優れたAIを作っていくという点に面白さを感じます。DXを推進しようとしているクライアントに対して、先端技術としてAIを提案し、クライアントと共に、AIに関する知見を深めていくというアプローチに興味があります。
                </div>
              </div>
            </div>
          </div>
          <!-- End Row -->

          <!-- Row -->
          <div class="vp row mb-5">            
            <div class="vp-details col-md-9 col-lg-9 shadow rounded mr-lg-5">
              <div class="job-list-info">
                <div class="job-list-option pt-3 pb-5 text-dark">
                  私はAIプロジェクトに携わっています。店舗の売上や需要予測、画像から特定の物体を検出する技術の高速化など手掛けてきました。技術の進歩が速い分野なので、クライアントと試行錯誤しながらプロジェクトを進めていきます。うまくいかないことも多いですが、結果が出始めるとクライアントとの距離もぐっと近づき、やりがいも感じられます。
                </div>
              </div>
            </div>
            <div class="vp-img col-md-3 col-lg-2 text-center">
              <p class="text-blue">
                <img src="/assets/img/avatar-people01.png" alt="T氏" class="img-fluid" />
                <b class="p-1 d-block">T氏</b>
              </p>
            </div>
          </div>
          <!-- End Row -->

          <!-- Row -->
          <div class="vp row mb-5">
            <div class="vp-img col-md-3 col-lg-2 text-center">
              <p class="text-blue">
                <img src="/assets/img/avatar-people01.png" alt="O氏" class="img-fluid" />
                <b class="p-1 d-block">O氏</b>
              </p>
            </div>
            <div class="vp-details col-md-9 col-lg-9 shadow rounded ml-lg-5">
              <div class="job-list-info">
                <div class="job-list-option pt-3 pb-5 text-dark">
                  DX推進の支援の仕事をしました。クライアント先はDX推進部門を設立したものの、DX部門はありとあらゆるタスクが各部門から依頼されるため現場は混とんとします。その中で行われる業務整理や体制定義、開発生成構築を行いました。<br>
                  DXは各社取り組み始めたばかりですのでとても思いで深いプロジェクトとなりました。
                </div>
              </div>
            </div>
          </div>
          <!-- End Row -->
        </div>
      </div>
    </section>
    <!--=================================
End Voices of people  -->

    <!--=================================
Register  -->
    <section class="custom-space-ptb bg-orange pd-0 mt-5" v-if="!isLogin">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center py-4">
            <h2 class="text-white mb-4">非公開案件に興味がある方</h2>
            <a class="btn white-btn border-white btn-lg text-blue shadow custom-regis-btn" href="/register"><i class="fas fa-sign-in-alt pr-md-5"></i> 無料登録はこちら</a>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Register  -->

    <!--=================================
Notice -->
    <section class="space-ptb bg-light news-block" id="news_block">
      <div class="container">
        <div class="bg-white p-3 p-sm-4 p-md-5">
          <div class="row align-items-center">
            <div class="col-12">
              <h2 class="news-title text-blue">
                お知らせ
              </h2>

              <dl>
                <dt>2020.11.13</dt>
                <dd>
                  <a href="/news/201113" title="PrimeDXをリリースしました。">PrimeDXをリリースしました。</a>
                </dd>
              </dl>

              <div class="text-right pt-5">
                <a href="/news" class="btn white-btn blue-border rounded text-blue font-weight-normal">
                  <span class="pl-2 pr-4">一覧へ</span><i class="fas fa-tasks"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Notice  -->

    <!--=================================
    Custom Bottom -->
    <section class="custom-bottom" v-if="!isLogin">
      <div class="banner bg-holder bg-overlay-blue-30 text-white" style="background-image: url(/assets/img/bg-footer.jpg);background-position-y: 85%;">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <h2 class="text-white mb-0">簡単<span class="text-orange">1</span>分で無料会員登録</h2>
              <p class="lead mb-5 mb-lg-5 font-weight-normal"><b>希望条件に合うお仕事をメールでお届けします！</b></p>
              <a type="button" href="/register" class="btn orange-btn mt-5 mw-200 fs-20 position-relative">
                <span class="span-btn">実績</span>
                <i class="fas fa-sign-in-alt"></i> 無料登録はこちら
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
    Custom Bottom -->
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters(["settings"]),
    ...mapGetters("user", ["isLogin", "userData"])
  },
  data() {
    return {
      jobs: [],
      loading: false,
      job_enpoint: "job"
    };
  },
  created() {
    this.axiosConfig();
  },
  mounted() {
    this.getMasterData();
  },
  methods: {
    async getMasterData() {
      this.loading = true;
      const params = {};
      if (this.userData) {
        params.user_id = this.userData.id;
      }
      await axios.get("/job", params).then(
        res => {
          this.jobs = res.data.data;
          this.loading = false;
        },
        error => {
          this.loading = false;
        }
      );
    },
    async like(job_id, job_key) {
      if (!this.userData) {
        let params = {
          title: "ログイン",
          onPopup: res => {
            return setTimeout(() => {
              this.actionLike(job_id, job_key);
            }, 500);
          }
        };
        this.$modal.dialogLogin(params);
      } else {
        this.actionLike(job_id, job_key);
      }
    },
    async actionLike(job_id, job_key) {
      let _this = this;
      await axios.post("/job/like/" + job_id).then(
        res => {
          _this.jobs[job_key].liked = res.data;
        },
        error => {}
      );
    },
    axiosConfig() {
      axios.interceptors.request.use(function(config) {
        config.dontRedirectToLogin = true;
        return config;
      });
    },
    onClickApply(jobID) {
      let redirecUrl = this.job_enpoint + "/" + jobID;
      if (this.isLogin) {
        window.location.href = redirecUrl;
        return;
      }
      this.showLoginDialog(redirecUrl);
    },
    searchJobByCategory(category) {
      if (!category) return;
      window.location.href = "job-list?job_category=" + category.id;
    },
    searchJobByStyle(style) {
      if (!style) return;
      window.location.href = "job-list?work_style=" + style.id;
    },
    showLoginDialog(redirecUrl, callback) {
      let params = {
        title: "ログイン",
        redirecUrl: redirecUrl
      };
      if (callback) {
        params.callback = callback;
      }
      this.$modal.dialogLogin(params);
    }
  }
};
</script>
