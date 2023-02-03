<?php 
include("../includes/config.inc.php");
?>
<script language="javascript">
// directory of where all the images are
var cmThemeOfficeBase = '<?=$servidor_url?>/menu_java/img/';
</script>

<link rel="stylesheet" href="<?=$servidor_url?>/menu_java/template_css.css" type="text/css" /> <!-- rtl change -->
<link rel="stylesheet" href="<?=$servidor_url?>/menu_java/theme.css" type="text/css" />
<script language="JavaScript" src="<?=$servidor_url?>/menu_java/JSCookMenu.js" type="text/javascript"></script>
<script language="JavaScript" src="<?=$servidor_url?>/menu_java/theme.js" type="text/javascript"></script>
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td class="menubackgr"><div id="myMenuID"></div>
		<script language="JavaScript" type="text/javascript">
		var myMenu =
		[
				[null,':: Início','<?=$servidor_url?>/principal/index.php',null,'Painel de Controle'],
			_cmSplit,
			[null,':: Matrícula','<?=$servidor_url?>/cadastro_aluno/cadastro_aluno.php',null,'Painel de Controle'],
			_cmSplit,
			[null,':: Cadastros',null,null,'Painel de Controle',
				[null,':: Cadastro de Professores','<?=$servidor_url?>/cadastro_professor/cadastro_professor.php',null,'Painel de Controle'],
				[null,':: Cadastro de Disciplinas','<?=$servidor_url?>/cadastro_disciplinas/cadastro_disciplinas.php',null,'Painel de Controle'],
				[null,':: Cadastro de cursos','<?=$servidor_url?>/cadastro_cursos/cadastro_cursos.php',null,'Painel de Controle'],
				[null,':: Cadastro de escolas','<?=$servidor_url?>/cadastro_escola/cadastro_escola.php',null,'Painel de Controle'],
				[null,':: Per&iacute;odos','<?=$servidor_url?>/periodos/periodos.php',null,'Painel de Controle'],
            ],
			_cmSplit,
			[null,':: Relatórios',null,null,'Painel de Controle',
				[null,':: Alunos','<?=$servidor_url?>/relatorios_alunos/relatorios_alunos.php',null,'Painel de Controle'],
				[null,':: Turmas','<?=$servidor_url?>/relatorios_turmas/relatorios_turmas.php',null,'Painel de Controle'],
				[null,':: Matrículas','<?=$servidor_url?>/relatorios/matriculas.php',null,'Painel de Controle'],
				[null,':: Per&iacute;odos','<?=$servidor_url?>/relatorios/periodos.php',null,'Painel de Controle'],
			],
			_cmSplit,
			[null,':: Turmas','<?=$servidor_url?>/turmas/turmas.php',null,'Painel de Controle'],
			_cmSplit,
			<?php if($_SESSION[cook_perfil] == 'a'){ ?>
			[null,':: Usuários','<?=$servidor_url?>/usuarios/usuarios.php',null,'Painel de Controle'],
			_cmSplit,
			<?php } ?>
			//[null,':: Atualizar dados','<?=$servidor_url?>/atualizacao/iniciar.php',null,'Painel de Controle'],
			//_cmSplit,
			
			[null,':: Sair','<?=$servidor_url?>/login/sair.php',null,'Painel de Controle'],
			_cmSplit,


			//[null,':: Desligar Servidor','<?=$servidor_url?>/index.php?desligar=1',null,'Desligar o servidor'],
                        //_cmSplit


		];

		cmDraw ('myMenuID', myMenu, 'vbr', cmThemeOffice, 'ThemeOffice'); <!-- rtl change -->

		</script>

</td>

    </tr>

</table>



