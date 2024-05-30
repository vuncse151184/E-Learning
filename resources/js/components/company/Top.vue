<template>
  <div>
    <!--=================================
Banner -->
    <section class="position-relative">
      <div class="banner bg-holder bg-overlay-black-20 text-dark custom-banner" style="background-image: url(/assets/img/top-company-banner-02.jpg);">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-9 text-left">
              <p class="lead mb-0 font-weight-bold text-white">デジタルトランスフォーメーションで事業変革を！</p>
              <p class="lead mb-4 font-weight-bold text-white">DXプロ人材と共創しませんか？</p>
              <a href="#company_frm" class="btn white-btn custom-tpc-btn" @click="jump('#company_frm')">ご相談はこちら</a>
            </div>
          </div>
        </div>
        <div class="banner-line">
          <img src="/assets/img/banner-line-01.png" alt="banner" class="banner-line-left" />
          <img src="/assets/img/banner-line-02.png" alt="banner" class="banner-line-right" />
        </div>
      </div>
    </section>
    <!--=================================
End Banner -->

    <!--=================================
Conversion box -->
    <section class="custom-space-ptb">
      <div class="container">
        <!-- Row -->
        <div class="row">
          <!-- Title -->
          <div class="col-12 justify-content-center">
            <div class="section-title center custom-title">
              <h2 class="title text-blue">
                <span class="position-relative pl-4 pr-4">社内のDX化で困ったことはありませんか？</span>
              </h2>
            </div>
          </div>
          <!-- End Title -->
        </div>
        <!-- End Row -->

        <!-- Row -->
        <div class="pt-2 pb-4 text-center">
          <!-- Col 04 -->
          <img src="/assets/img/conversion-img.png" alt="img" class="img-fluid">
        </div>
        <!-- End Row -->
      </div>
    </section>
<!--=================================
End Conversion box -->

<!--=================================
Info box -->
    <section class="custom-space-info bg-orange">
      <div class="info-head text-center">
        <a href="#!"><i class="fas fa-arrow-circle-down"></i></a>
      </div>
      <div class="container">
        <!-- Row -->
        <div class="row">
          <!-- Title -->
          <div class="col-12 justify-content-center">
            <div class="section-title center custom-title">
              <h2 class="title text-blue">
                <span class="position-relative pl-4 pr-4 aft-bg-white">PrimeDXとは？</span>
              </h2>
              <div class="mt-4 text-white font-weight-bold">
                DXを推進するDXプロ人材をご紹介します。<br>
                コンサルタント、データサイエンティスト、<br>
                先端技術エンジニアなど様々なスキルを持つ方が登録<br>
              </div>
            </div>
          </div>
          <!-- End Title -->
        </div>
        <!-- End Row -->

        <!-- Row -->
        <div class="pt-2 pb-4 text-center">
          <img src="/assets/img/primedx-info.png" alt="img" class="img-fluid" />
        </div>
        <!-- End Row -->
      </div>
    </section>
    <!--=================================
End Info box -->

    <!--=================================
Contact box -->
    <section class="custom-contact-box pd-0" style="background: url(/assets/img/bg-contact-box.jpg) center no-repeat;">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6 text-center py-4">
            <h2 class="text-white mb-4">お問い合わせ</h2>
            <a href="#company_frm" title="ご相談はこちら" class="btn white-btn btn-lg shadow text-blue custom-regis-btn custom-tpc-btn" @click="jump('#company_frm')">ご相談はこちら</a>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Contact box -->

    <!--=================================
About box -->
    <section class="custom-space-ptb">
      <div class="container">
        <div class="section-title center custom-title pb-5">
          <h2 class="title text-blue">
            <span class="position-relative">プライムスタイルの紹介</span>
          </h2>
        </div>
        <div class="row align-self-center p-sm-3 pt-md-5">
          <div class="col-lg-8 col-md-12">
            <div class="row">
              <img src="/assets/img/about-logo.png" alt="about logo" class="img-fluid pl-3 pr-2 pb-3" />
              <h2 class="pl-3">
                代表取締役社長<br />
                奥田　聡
              </h2>
            </div>
            <p class="text-dark pt-5 pb-5">
              PwCやベンチャーキャピタルでコンサルタントとしてキャリアを積んだ後プライムスタイルを創業。これまで大企業・中小・ベンチャーの様々な業界の最先端IT技術を使った新規事業立ち上げを支援。<br>
              ジャパンビジネスモデル・コンペティション実行委員、<br>
              スタートアップハブ東京コンシェルジュ、<br>
              早稲田大学グローバル科学知融合研究所 招聘研究員。AIに関する論文を複数学会発表。
            </p>
          </div>
          <div class="col-lg-4 col-md-12 text-center pb-5">
            <img src="/assets/img/about-img-01.jpg" alt="img" class="img-fluid" />
          </div>
          <div class="col-12 pt-4 pb-4 text-white">
            <div class="bg-blue pt-4 pb-4">
              <div class="text-center p-4">
                <h2 class="text-white mb-4">プライムグループの技術提供サービス</h2>
                <p class="font-weight-bold">
                  早稲田大学及び北陸先端科学技術大学院大学との共同研究体制が2020年4月から立ち上がる。<br>
                  本研究ネットワークをご活用いただくことが可能です。
                </p>
              </div>
              <div class="row text-center ml-3 mr-3">
                <div class="col-12">
                  <p class="border rounded p-3 font-weight-bold">プライムグループ</p>
                </div>
                <div class="col-12 col-sm-6">
                  <p class="border rounded p-3 font-weight-bold">国内AI・データサイエンティスト人材</p>
                </div>
                <div class="col-12 col-sm-6 mb-4">
                  <p class="border rounded p-3 font-weight-bold">海外AI・データサイエンティスト人材</p>
                </div>
                <div class="col-sm-4 border-sm-right mb-4">
                  <b>北陸先端科学技術大学院大学</b><br><br>
                  <p class="text-left">JAISTは科学技術研究者を養成する国立の大学院。科学技術領域で博士をとるのは昨今外国人が多く、ベトナム人データサイエンティストやAI研究者との共同開発体制を組む。
                  </p>
                </div>
                <div class="col-sm-4 border-sm-right mb-4">
                  <b>早稲田大学</b><br><br>
                  <p class="text-left">早稲田大学の産学連携棟である研究開発センター121号館が4月より新設。TLO、オープンイノベーション、産学連携部署が本新棟に集約される。理工学学術院教授・高度データ関連人材育成プログラム実施責任者の朝日教授とともにプライムスタイルー早稲田大学間で共同研究を実施。
                  </p>
                </div>
                <div class="col-sm-4 mb-4">
                  <b>PRIME LABO</b><br><br>
                  <p class="text-left">ベトナム国ホーチミン市のソフトウェアパーク内のPrimelabo社の開発環境による実働部隊のレバレッジが可能。本チームはオフショア開発部隊のため安価に利用が可能である。QTSCは1万人のエンジニアと1万人の学生がいるソフトウェア専用のパークであり市内からも少し離れており採用は比較的簡単。研究開発型プロジェクトに優れる。
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 justify-content-center mt-5">
            <div class="section-title center custom-title">
              <h2 class="title text-blue">
                <span class="position-relative pl-4 pr-4">先端技術活用プロジェクト実績一覧</span>
              </h2>
              <p class="text-dark text-left px-sm-5">機械学習、ディープラーニングやブロックチェーンなどの先端技術を活用したプロジェクト実績が多数あります。</p>
            </div>
            <div class="bg-grey pt-2">
              <div class="p-4 row text-dark list-style-none">
                <p class="col-sm-6">・AIモデル動的評価ツール</p>
                <p class="col-sm-6">・レシート情報のデータ化</p>
                <p class="col-sm-6">・アパレル自動ラベリングサービス</p>
                <p class="col-sm-6">・ATM装填業務最適化</p>
                <p class="col-sm-6">・リソース最適化システム</p>
                <p class="col-sm-6">・SNNを使用した物体検出</p>
                <p class="col-sm-6">・オンライン会議自動翻訳システム</p>
                <p class="col-sm-6">・新規仮想通貨開発</p>
                <p class="col-sm-6">・自動Q&A生成支援システム</p>
                <p class="col-sm-6">・仮想通貨(ECR20ベース）Mobile Wallet開発</p>
                <p class="col-sm-6">・居眠り検知システム</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End About box -->

    <!--=================================
Contact box 2 -->
    <section class="custom-space-ptb bg-blue pd-0">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center py-4">
            <h2 class="text-white mb-4">お問い合わせ</h2>
            <a href="#company_frm" title="ご相談はこちら" class="btn white-btn border-white btn-lg shadow text-blue custom-regis-btn custom-tpc-btn" @click="jump('#company_frm')">ご相談はこちら</a>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Contact box 2 -->

    <!--=================================
Particular box-->
    <section class="custom-space-ptb custom-particular bg-grey2">
      <div class="container">
        <div class="row">
          <div class="col-md-12 justify-content-center">
            <div class="section-title center custom-title">
              <h2 class="title text-blue">
                <span class="position-relative pl-4 pr-4">DX人材のご紹介</span>
              </h2>
            </div>
          </div>
          <div class="row p-3 pl-sm-5 pr-sm-5 custom-vp2">
            <!-- Row -->
            <div class="vp col-sm-6 mb-5 px-2">
              <div class="vp-details d-flex flex-column justify-content-between">
                <div class="job-list-info">
                  <div class="job-list-title pt-4 pb-2">
                    <h4>
                      <a href="#!" title="T氏" class="text-blue">
                        データサイエンティスト
                        <span class="text-dark pl-sm-3">T氏</span>
                      </a>
                    </h4>
                  </div>
                  <div class="job-list-option pt-4 text-dark">
                    <p class="pb-3">
                      2003年に大学院修了後、SI事業会社にてシステムエンジニアとして、モーションキャプチャシステム、生体信号処理・解析システムの開発案件に従事。その後、システムエンジニアとして、主に業務用ネットワークプロジェクターのソフトウェアの開発案件に従事。<br>
                      現在はAI関連のプロジェクトマネジメントにて多数従事。
                    </p>
                  </div>
                </div>
                <div class="text-center text-md-right"><a href="/company/register" class="btn white-btn blue-border text-blue">詳しくを見る <i class="fas fa-angle-double-right pl-4"></i></a></div>
              </div>
            </div>
            <!-- End Row -->

            <!-- Row -->
            <div class="vp col-sm-6 mb-5 px-2">
              <div class="vp-details d-flex flex-column justify-content-between">
                <div class="job-list-info">
                  <div class="job-list-title pt-4 pb-2">
                    <h4>
                      <a href="#!" title="B氏" class="text-blue">
                        AIプロフェッショナル
                        <span class="text-dark pl-sm-3">B氏</span>
                      </a>
                    </h4>
                  </div>
                  <div class="job-list-option pt-4 text-dark">
                    <p class="pb-3">
                      2016年4月から早稲田大学大学院に所属。金属多孔質膜を用いたバイオセンシングに関して研究を推進し、生物物性科学という専攻で博士(工学)を取得。<br>
                      2019年3月に、博士後期課程を修了した後は、産業技術総合研究所にて、AIを用いたレーザー加工技術の最適化に関して、研究を推進。<br>
                      AIに関して、強い関心があり、自分が、研究所で学んだ知識や経験を社会の中で役立てたいという気持ちを持っている。<br>
                      AI技術を中心としたお客様の要件定義やプロジェクトマネジメント、システム開発を担当。
                    </p>
                  </div>
                </div>
                <div class="text-center text-md-right"><a href="/company/register" class="btn white-btn blue-border text-blue">詳しくを見る <i class="fas fa-angle-double-right pl-4"></i></a></div>
              </div>
            </div>
            <!-- End Row -->

            <!-- Row -->
            <div class="vp col-sm-6 mb-5 px-2">
              <div class="vp-details d-flex flex-column justify-content-between">
                <div class="job-list-info">
                  <div class="job-list-title pt-4 pb-2">
                    <h4>
                      <a href="#!" title="H氏" class="text-blue">
                        DXコンサル
                        <span class="text-dark pl-sm-3">H氏</span>
                      </a>
                    </h4>
                  </div>
                  <div class="job-list-option pt-4 text-dark">
                    <p class="pb-3">
                      都市銀行システム部にて、ヨーロッパ拠点向けのシステム開発に従事。<br>
                      ネットを活用した補償ビジネスを立ち上げる（上場企業へ事業譲渡）。<br>
                      その後、アプリ事業、キュレーションメディア事業の立ち上げ開発に従事（上場企業へ売却）。<br>
                      現在は、同時に複数社の新規事業・DX化支援中。
                    </p>
                  </div>
                </div>
                <div class="text-center text-md-right"><a href="/company/register" class="btn white-btn blue-border text-blue">詳しくを見る <i class="fas fa-angle-double-right pl-4"></i></a></div>
              </div>
            </div>
            <!-- End Row -->

            <!-- Row -->
            <div class="vp col-sm-6 mb-5 px-2">
              <div class="vp-details d-flex flex-column justify-content-between">
                <div class="job-list-info">
                  <div class="job-list-title pt-4 pb-2">
                    <h4>
                      <a href="#!" title="N氏" class="text-blue">
                        DX顧問（CFO系）
                        <span class="text-dark pl-sm-3">N氏</span>
                      </a>
                    </h4>
                  </div>
                  <div class="job-list-option pt-4 text-dark">
                    <p class="pb-3">
                      ジャスダック上場企業（売上100億円規模）にて、管理部門マネジメントおよび社内体制の整備に従事。<br>
                      東証２部上場企業（売上100億円規模）にて管理部門のマネジメントに加え、事業の成長に合わせグループの組織再編を行い、ホールディング体制への移行。グループ経営をＣＦＯとして推進。<br>
                      その後、米国NASDAQ上場企業においては、執行役員 ＣＦＯとしてＩＴを使って米国での訴訟における電子開示制度を支援、不正調査、知的財産コンサル等を担当。その後、人材系ベンチャー企業の取締役CFOとして上場支援。同時に、テクノロジー系ベンチャー企業（マザーズ上場）の社外取締役として経営支援。現在は延べ70 社以上の顧問、コンサル、取締役（常勤・半常勤）、社外取締役などの形で関与。
                    </p>
                  </div>
                </div>
                <div class="text-center text-md-right"><a href="/company/register" class="btn white-btn blue-border text-blue">詳しくを見る <i class="fas fa-angle-double-right pl-4"></i></a></div>
              </div>
            </div>
            <!-- End Row -->

            <!-- Row -->
            <div class="vp col-sm-6 mb-5 px-2">
              <div class="vp-details d-flex flex-column justify-content-between">
                <div class="job-list-info">
                  <div class="job-list-title pt-4 pb-2">
                    <h4>
                      <a href="#!" title="O氏" class="text-blue">
                        DX顧問（事業開発）
                        <span class="text-dark pl-sm-3">O氏</span>
                      </a>
                    </h4>
                  </div>
                  <div class="job-list-option pt-4 text-dark">
                    <p class="pb-3">
                      開発系ベンチャー企業（1200名規模）にて、海外のエンジニアチームをマッチングするグローバルソーシングプラットフォームの事業を推進。<br>
                      その後、営業・マーケティング統括として、国内で年間約20億の売上の成⻑まで貢献。海外企業の買収にあたってはビジネスサイドのDDを担当。2018年3⽉までに12カ国、21都市に拠点を設け、1,000名の社員を抱える規模の成⻑に寄与。<br>
                      シンガポール子会社の代表取締役COOに就任。海外営業およびM&A推進として会社の成長を担う。<br>
                      その後、グループ会社の代表となりAR技術を活用したベンチャーを創業。<br>
                      同時に、IT企業の営業・開発・経営⾯で複数社支援を行う。
                    </p>
                  </div>
                </div>
                <div class="text-center text-md-right"><a href="/company/register" class="btn white-btn blue-border text-blue">詳しくを見る <i class="fas fa-angle-double-right pl-4"></i></a></div>
              </div>
            </div>
            <!-- End Row -->

            <!-- Row -->
            <div class="vp col-sm-6 mb-5 px-2 d-flex justify-content-center align-items-center">
                <a href="/company/register" class="btn blue-btn text-white">もっとDX人材の資料はこちら <i class="fas fa-eye"></i></a>
            </div>
            <!-- End Row -->
          </div>
        </div>
      </div>
    </section>
    <!--=================================
End Particular box-->

    <!--=================================
    Custom Bottom -->
    <section class="custom-bottom">
      <div class="banner bg-holder bg-overlay-blue-30 text-white" style="background-image: url(/assets/img/bg-footer-2.jpg);">
        <div class="space-ptb pt-3 mb-5 position-relative">
          <div class="container">
            <div class="col-lg-10 m-auto" id="company_frm">
              <div class="section-title-02 custom-contact-title">
                <h2 class="text-center text-white">
                  共にDXを成功させましょう！<br>
                  ご相談ください。
                </h2>
              </div>
            </div>
            <div class="col-12">
              <div class="bg-orange text-center p-4 mt-5 mb-5 fs-20 font-weight-bold">
                <span class="d-inline-block">お電話でのお問い合わせ</span>
                <span class="d-inline-block pl-sm-5">03-6281-9803</span><br>
                <span class="d-inline-block pr-sm-2">受付時間</span>
                <span class="d-inline-block">10：00～19：00</span>
                <span class="d-inline-block">（土日祝日を除く）</span>
              </div>
            </div>
            <ContactForm/>
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
import ContactForm from "./../layouts/company_inc/ContactForm";
export default {
  data() {
    return {};
  },
  components: {
    ContactForm,
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("company", ["companyData"])
  },
  methods: {
    jump(hash) {
      $('html, body').animate({
				scrollTop: $(hash).offset().top
			 }, 1000, function(){
				// when done, add hash to url
				// (default click behaviour)
				window.location.hash = hash;
			});
    }
  }
};
</script>
