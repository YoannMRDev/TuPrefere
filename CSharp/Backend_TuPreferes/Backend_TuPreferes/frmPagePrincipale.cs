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
            functionDB = new FunctionDB(new DB("localhost", "root", "Super", "dbTuPrefere",3306));
            LoadAllDilemmesInListBoxDilemme(functionDB.GetAllDilemma());
            LoadAllDilemmesInListBoxCategorie(functionDB.GetAllCategory());
            LoadCategoriesToComboBox(functionDB.GetAllCategory());
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
                string text = $" ID : {row[0]} - Nom : {row[1]} - Archiver : {row[2]} ";
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
            btnModifierDilemme.Enabled = lsbDilemmes.SelectedItem != null;
        }



        private void btnSupprimerDilemme_Click(object sender, EventArgs e)
        {
            if (lsbDilemmes.SelectedItem != null)
            {
                // Récupère l'id dans le texte
                string[] array = lsbDilemmes.SelectedItem.ToString().Split(',');
                int id = Convert.ToInt32(array[0].Substring(array.Length));

                functionDB.DeleteDilemma(id);

                // Recharge les données
                LoadAllDilemmesInListBoxDilemme(functionDB.GetAllDilemma());
            }
        }

        private void btnModifierDilemme_Click(object sender, EventArgs e)
        {
            //if (lsbDilemmes.SelectedItem != null)
            //{
            //    // Récupère l'id dans le texte
            //    string[] array = lsbDilemmes.SelectedItem.ToString().Split(',');
            //    int id = Convert.ToInt32(array[0].Substring(array.Length));

            //    frmAjouterDilemme frmModifierDilemme = new frmAjouterDilemme(functionDB, functionDB.GetDilemmaOfId(id));

            //    DialogResult result = frmModifierDilemme.ShowDialog();

            //    if (result == DialogResult.OK)
            //    {

            //    }
            //}
        }

   private void btnAjoutCategorie_Click(object sender, EventArgs e)
{
    string newCategory = tbxCategorie.Text;
    if (!string.IsNullOrWhiteSpace(newCategory))
    {
        string result = functionDB.AddCategory(newCategory);
        MessageBox.Show(result);
        
        // Rafraîchir la liste des catégories dans la ComboBox après l'ajout
        LoadCategoriesToComboBox(functionDB.GetAllCategory());
    }
    else
    {
        MessageBox.Show("Veuillez entrer le nom de la nouvelle catégorie.");
    }
}

        private void lsbCategorie_SelectedIndexChanged(object sender, EventArgs e)
        {
            // Vérifier si un élément est sélectionné dans la ListBox
            if (lsbCategorie.SelectedItem != null)
            {
                // Supposons que le texte de l'élément sélectionné est au format "ID : 1 - Nom : Ecologie - Archiver : False"
                string selectedItem = lsbCategorie.SelectedItem.ToString();

                // Extraire l'ID de l'élément sélectionné
                int id;
                string[] parts = selectedItem.Split(new string[] { "ID :" }, StringSplitOptions.RemoveEmptyEntries);
                if (parts.Length >= 2)
                {
                    string idPart = parts[1].Split('-')[0].Trim();
                    if (int.TryParse(idPart, out id))
                    {
                        // Appeler la méthode ToggleArchive avec l'ID extrait
                        string result = functionDB.ToggleArchive(id);

                        // Afficher le résultat
                    }
    
                }
    
            }
  

            LoadAllDilemmesInListBoxCategorie(functionDB.GetAllCategory());
        }

        private void btnModifierCategorie_Click(object sender, EventArgs e)
        {
            functionDB.ModifyCategoryName(cbxCategorie.Text, tbxModifierCategorie.Text);
            LoadAllDilemmesInListBoxCategorie(functionDB.GetAllCategory());
        }


        private void cbxCategorie_SelectedIndexChanged(object sender, EventArgs e)
        {
            LoadAllDilemmesInListBoxCategorie(functionDB.GetAllCategory());
            tbxModifierCategorie.Text = cbxCategorie.Text;
        }


        private void LoadCategoriesToComboBox(List<string[]> results)
        {
            cbxCategorie.Items.Clear();
            foreach (string[] row in results)
            {
                // Ajouter le nom de la catégorie à la ComboBox
                cbxCategorie.Items.Add(row[1]);
            }
        }
    }
}
