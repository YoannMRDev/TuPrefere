using Backend_TuPreferes.DataBase;
using MySqlX.XDevAPI.Common;
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

namespace Backend_TuPreferes
{
    public partial class frmPagePrincipale : Form
    {
        FunctionDB functionDB;
        public frmPagePrincipale()
        {
            InitializeComponent();
            functionDB = new FunctionDB(new DB("localhost", "root", "Super", "TuPrefere"));
            LoadAllDilemmesInListBoxDilemme(functionDB.GetAllDilemma());
            LoadAllDilemmesInListBoxCategorie(functionDB.GetAllCategory());
        }

        /// <summary>
        /// Mettre toutes les infos récupéres des dilemmes dans la listbox
        /// </summary>
        /// <param name="results"></param>
        private void LoadAllDilemmesInListBoxDilemme(List<string[]> results)
        {
            lsbDilemmes.Items.Clear();
            foreach (string[] row in results)
            {
                string text = $"Id : {row[0]}, Choix 1 : {row[1]}, Choix 2 : {row[2]}, Archiver : {row[3]},Categorie : {functionDB.GetNomCategoryById(Convert.ToInt32(row[4]))}";
                lsbDilemmes.Items.Add(text);
            }
        }

        /// <summary>
        /// Mettre toutes les infos récupéres des categories dans la listbox
        /// </summary>
        /// <param name="results"></param>
        private void LoadAllDilemmesInListBoxCategorie(List<string[]> results)
        {
            lsbCategorie.Items.Clear();
            foreach (string[] row in results)
            {
                string text = $"Nom : {row[1]}";
                lsbCategorie.Items.Add(text);
            }
        }


        private void btnAjouter_Click(object sender, EventArgs e)
        {
            frmAjouterDilemme ajouterDilemme = new frmAjouterDilemme(functionDB);

            DialogResult result = ajouterDilemme.ShowDialog();

            if (result == DialogResult.OK)
            {
                functionDB.AddDilemma(ajouterDilemme.GetChoix1(), ajouterDilemme.GetChoix2(), ajouterDilemme.GetCategorie());
                LoadAllDilemmesInListBoxDilemme(functionDB.GetAllDilemma());
            }
        }

        private void tbxRechercheDilemme_TextChanged(object sender, EventArgs e)
        {
            btnRechercheDilemme.Enabled = tbxRechercheDilemme.Text != "";
        }

        private void btnRechercheDilemme_Click(object sender, EventArgs e)
        {
            int id = functionDB.GetCategoryByName(tbxRechercheDilemme.Text);
            if (id != -1)
            {
                LoadAllDilemmesInListBoxDilemme(functionDB.GetAllDilemmaOfCategory(tbxRechercheDilemme.Text));
            }
            else
            {
                MessageBox.Show("Cette catégorie n'existe pas", "Attention");
            }
        }

        private void btnResetDilemme_Click(object sender, EventArgs e)
        {
            LoadAllDilemmesInListBoxDilemme(functionDB.GetAllDilemma());
        }

        private void lsbDilemmes_SelectedIndexChanged(object sender, EventArgs e)
        {
            btnSupprimerDilemme.Enabled = lsbDilemmes.SelectedItem != null;
        }

        private void btnSupprimerDilemme_Click(object sender, EventArgs e)
        {
            if (lsbDilemmes.SelectedItem != null)
            {
                // Récupère l'id dans le texte
                string text = lsbDilemmes.SelectedItem.ToString();
                string[] array = text.Split(',');
                int id = Convert.ToInt32(array[0].Substring(array.Length));

                functionDB.DeleteDilemma(id);

                // Recharge les données
                LoadAllDilemmesInListBoxDilemme(functionDB.GetAllDilemma());
            }
        }
    }
}
