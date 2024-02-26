using Backend_TuPreferes.DataBase;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
/*
 * Auteur : Yoann Meier, Alexandre Babich
 * Projet : Administration du jeu web Tu Prefere
 * Description : Page pour ajouter ou modifier un dilemme
 */
namespace Backend_TuPreferes
{
    public partial class frmAjouterModifierDilemme : Form
    {
        List<string[]> categories;

        public frmAjouterModifierDilemme(FunctionDB functionDB)
        {
            InitializeComponent();

            // Initialize le combobox avec toutes les catégories
            categories = functionDB.GetAllCategory();
            foreach (string[] row in categories)
            {
                cmbCategorie.Items.Add(row[1]);
            }

            // Met le premier élément par défaut
            cmbCategorie.SelectedItem = cmbCategorie.Items[0];
        }

        public frmAjouterModifierDilemme(FunctionDB functionDB, List<string[]> data) : this(functionDB)
        {
            // Remplis les champs des valeurs transmis
            tbxChoix1.Text = data[0][1];
            tbxChoix2.Text = data[0][2];
            // Récupère l'index de la catégorie
            int index = cmbCategorie.Items.IndexOf(functionDB.GetNomCategoryById(Convert.ToInt32(data[0][4])));
            cmbCategorie.SelectedItem = cmbCategorie.Items[index];
            cbxArchiver.Enabled = true;
            cbxArchiver.Visible = true;
            cbxArchiver.Checked = Convert.ToBoolean(data[0][3]);

            lblTitre.Text = "Modifier un dilemme";
            btnAjouterModifier.Text = "Modifier un dilemme";
            this.Text = "Modifier un dilemme";
        }

        /// <summary>
        /// Retourne le premier choix
        /// </summary>
        public string GetChoix1()
        {
            return tbxChoix1.Text;
        }

        /// <summary>
        /// Retourne le deuxième choix
        /// </summary>
        public string GetChoix2()
        {
            return tbxChoix2.Text;
        }

        /// <summary>
        /// Retourne la catégorie
        /// </summary>
        public string GetCategorie()
        {
            return cmbCategorie.Text;
        }

        /// <summary>
        /// Retourne si la question est archivé
        /// </summary>
        public int GetArchiver()
        {
            return cbxArchiver.Checked ? 1 : 0;
        }

        /// <summary>
        /// Active ou désactive le bouton pour ajouter ou modifier un dilemme
        /// </summary>
        public void EnabledButtonAdd(object sender, EventArgs e)
        {
            btnAjouterModifier.Enabled = tbxChoix1.Text != "" && tbxChoix2.Text != "" && cmbCategorie.Text != "";
        }
    }
}
