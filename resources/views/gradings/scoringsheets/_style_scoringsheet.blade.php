
  <style media="screen">
      #table-scroll {
        margin-left: 1px;
      }
      .table-scroll {
        position:relative;
        max-width:1600px;
        margin:auto;
        overflow:hidden;
      }
      .table-wrap {
        width:100%;
        overflow:auto;
      }
      .table-scroll table {
        width:100%;
        margin:auto;
        border-collapse:separate;
        border-spacing:0;
      }
      .table-scroll th, .table-scroll td {
        padding:5px 10px;
        border:1px solid #eee;
        background:#fff;
        white-space:nowrap;
        vertical-align:top;
      }
      .table-scroll thead, .table-scroll tfoot {
        background:#f9f9f9;
      }
      .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
      }
      .clone th, .clone td {
        visibility:hidden
      }
      .clone td, .clone th {
        border-color:transparent
      }
      .clone tbody th {
        visibility:visible;
        color:red;
      }
      .clone .fixed-side {
        border:1px solid white;
        background:#eee;
        visibility:visible;
      }
      .clone thead, .clone tfoot{background:transparent;}
      #grey-cell {
        border:1px solid white;
        background:#eee;
        visibility:visible;
      }
  </style>
